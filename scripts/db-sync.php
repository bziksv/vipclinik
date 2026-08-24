#!/usr/bin/env php
<?php
/**
 * Синхронизация БД WordPress после деплоя файлов.
 * Запуск на Beget: BEGET_WEB=~/vipclinik.com/public_html php scripts/db-sync.php
 */
if ( PHP_SAPI !== 'cli' ) {
	exit( 1 );
}

$repo_root = dirname( __DIR__ );
$web       = getenv( 'BEGET_WEB' ) ?: ( getenv( 'HOME' ) . '/vipclinik.com/public_html' );
$wp_load   = rtrim( $web, '/' ) . '/wp-load.php';

if ( ! is_file( $wp_load ) ) {
	fwrite( STDERR, "Не найден wp-load.php: {$wp_load}\n" );
	exit( 1 );
}

require $wp_load;

global $wpdb;

$url_replacements = array(
	'/wp-content/uploads/2026/02/cookies-vipclinic.pdf'              => '/wp-content/documents/cookies.pdf',
	'/wp-content/uploads/2026/03/consent-personal-data-vipclinic.pdf' => '/wp-content/documents/consent.pdf',
	'/wp-content/uploads/2026/03/personal-data-vipclinic.pdf'          => '/wp-content/documents/personal-data.pdf',
	'/wp-content/uploads/2026/03/rules-recommendation-vipclinic.pdf' => '/wp-content/documents/rules-recommendation.pdf',
	'/wp-content/documents/cookies-vipclinic.pdf'                    => '/wp-content/documents/cookies.pdf',
	'/wp-content/documents/consent-personal-data-vipclinic.pdf'     => '/wp-content/documents/consent.pdf',
	'/wp-content/documents/personal-data-vipclinic.pdf'              => '/wp-content/documents/personal-data.pdf',
	'/wp-content/documents/rules-recommendation-vipclinic.pdf'       => '/wp-content/documents/rules-recommendation.pdf',
);

/**
 * @param mixed $value
 * @return mixed
 */
function clinic_db_replace_recursive( $value, array $replacements ) {
	if ( is_string( $value ) ) {
		return str_replace( array_keys( $replacements ), array_values( $replacements ), $value );
	}
	if ( is_array( $value ) ) {
		foreach ( $value as $key => $item ) {
			$value[ $key ] = clinic_db_replace_recursive( $item, $replacements );
		}
	}
	return $value;
}

echo "→ DB sync ({$wpdb->dbname})\n";

// Cookie-баннер GDPR (Moove).
$gdpr_file = $repo_root . '/scripts/db/gdpr-infobar.html';
if ( is_file( $gdpr_file ) ) {
	$html = trim( file_get_contents( $gdpr_file ) );
	$opts = get_option( 'moove_gdpr_plugin_settings' );
	if ( ! is_array( $opts ) ) {
		$opts = array();
	}
	$opts['moove_gdpr_info_bar_content'] = $html;
	update_option( 'moove_gdpr_plugin_settings', $opts );
	echo "  moove_gdpr_info_bar_content — обновлён\n";
}

// Старые URL в опциях (рекурсивно, без поломки serialize).
$like = '%uploads/2026/%';
$rows = $wpdb->get_results(
	$wpdb->prepare(
		"SELECT option_name FROM {$wpdb->options} WHERE option_name NOT LIKE %s AND ( option_value LIKE %s OR option_value LIKE %s OR option_value LIKE %s )",
		$wpdb->esc_like( '_transient_' ) . '%',
		'%uploads/2026/%',
		'%vipclinic.pdf%',
		'%/wp-content/documents/consent-personal%'
	)
);
$options_updated = 0;
foreach ( $rows as $row ) {
	$value = get_option( $row->option_name );
	if ( $value === false ) {
		continue;
	}
	$new = clinic_db_replace_recursive( $value, $url_replacements );
	if ( $new !== $value ) {
		update_option( $row->option_name, $new );
		++$options_updated;
	}
}
echo "  wp_options — {$options_updated} записей\n";

// Посты и мета (страницы, формы CF7 и т.д.).
$posts_updated = 0;
foreach ( $url_replacements as $old => $new ) {
	$posts_updated += (int) $wpdb->query(
		$wpdb->prepare(
			"UPDATE {$wpdb->posts} SET post_content = REPLACE(post_content, %s, %s) WHERE post_content LIKE %s",
			$old,
			$new,
			'%' . $wpdb->esc_like( $old ) . '%'
		)
	);
	$wpdb->query(
		$wpdb->prepare(
			"UPDATE {$wpdb->postmeta} SET meta_value = REPLACE(meta_value, %s, %s) WHERE meta_value LIKE %s",
			$old,
			$new,
			'%' . $wpdb->esc_like( $old ) . '%'
		)
	);
}
echo "  wp_posts — {$posts_updated} строк с URL\n";

$wpdb->query(
	"DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_gdpr_%' OR option_name LIKE '_transient_timeout_gdpr_%'"
);

echo "✓ DB sync готово\n";
