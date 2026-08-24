<?php
/**
 * Пример конфигурации WordPress для продакшена (Beget).
 * Скопируйте на сервер как wp-config.php и заполните значения.
 *
 * Локально используется wp-config-local.php (создаётся автоматически при разработке).
 */

if ( file_exists( __DIR__ . '/wp-config-local.php' ) ) {
	require __DIR__ . '/wp-config-local.php';
} else {
	define( 'WP_CACHE', true );
	define( 'WPCACHEHOME', '/home/v/vipclinik/vipclinik.com/public_html/wp-content/plugins/wp-super-cache/' );
	define( 'DB_NAME', 'vipclinik_s' );
	define( 'DB_USER', 'vipclinik_s' );
	define( 'DB_PASSWORD', 'ЗАМЕНИТЕ_НА_ПАРОЛЬ_ИЗ_ПАНЕЛИ_BEGET' );
	define( 'DB_HOST', 'localhost' );
}

define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

define( 'AUTH_KEY',         'сгенерируйте на https://api.wordpress.org/secret-key/1.1/salt/' );
define( 'SECURE_AUTH_KEY',  '...' );
define( 'LOGGED_IN_KEY',    '...' );
define( 'NONCE_KEY',        '...' );
define( 'AUTH_SALT',        '...' );
define( 'SECURE_AUTH_SALT', '...' );
define( 'LOGGED_IN_SALT',   '...' );
define( 'NONCE_SALT',       '...' );

$table_prefix = 'wp_';

if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

require_once ABSPATH . 'wp-settings.php';
