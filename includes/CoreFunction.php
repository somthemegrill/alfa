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

		if ( version_compare( PHP_VERSION, '8.0', '<' ) ) {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					echo __( 'Please update your <strong>PHP</strong> version to at least 8.3 version to use <strong>Job Application Form</strong> Plugin.', 'ts-job-application-form' );
					?>
				</p>
			</div>
			<?php
		}

		if ( version_compare( $wp_version, '6.4', '<' ) ) {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					echo __( 'Please update your <strong>WordPress</strong> version to at least 6.3.2 version to use <strong>Job Application Form</strong> Plugin.', 'ts-job-application-form' );
					?>
				</p>
			</div>
			<?php
		}

		$message .= ob_get_clean();
		echo wp_kses_post( $message );

	}
}
