<?php
/**
 * Plugin Name: VIP Clinik Local Dev
 * Description: Отключает SSL-редиректы на localhost.
 */

if ( ! defined( 'WP_HOME' ) || strpos( WP_HOME, 'localhost' ) === false ) {
	return;
}

add_filter(
	'option_active_plugins',
	static function ( $plugins ) {
		if ( ! is_array( $plugins ) ) {
			return $plugins;
		}

		return array_values(
			array_filter(
				$plugins,
				static function ( $plugin ) {
					return $plugin !== 'really-simple-ssl/rlrsssl-really-simple-ssl.php';
				}
			)
		);
	}
);

add_filter( 'rsssl_javascript_redirect', '__return_empty_string' );
