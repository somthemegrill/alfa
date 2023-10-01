<?php
/**
 * Alpha setup
 *
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'alpha_check_compatibility' ) ) {

	/**
	 * Check if the plugin is compatible with the current version of WordPress and PHP.
	 */

	function alpha_check_compatibility() {
		global $wp_version;
		$message = '';

		ob_start();

		if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
			$message .= '<p>' . __( 'Alpha requires PHP version 5.6+, plugin is currently NOT RUNNING.', 'alpha' ) . '</p>';
		}

		if ( version_compare( $wp_version, '4.7', '<' ) ) {
			$message .= '<p>' . __( 'Alpha requires WordPress version 4.7+, plugin is currently NOT RUNNING.', 'alpha' ) . '</p>';
		}

		$message .= ob_get_clean();
		echo wp_kses( $message );

	}
}
