<?php

/*
 * Alpha setup
 * @package Alpha\Install
 * @since 1.0.0
 */

namespace Alpha\Install;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Install class
 * @since 1.0.0
 */

if ( ! class_exists( 'Install' ) ) {

	class Install {

		/**
		 * Initial actions to run when install class is run.
		 *
		 * @since 1.0.0
		 */
		public static function init() {
			add_action( 'admin_init', array( __CLASS__, 'install' ) );
		}

		/**
		 * Install actions when plugin is activated.
		 *
		 * This function is hooked into admin_init to affect admin only.
		 */
		public static function install() {
			// Check if we are not already running this routine.
			if ( ! is_blog_installed() ) {
				return;
			}

			// Check if already installed.
			if ( get_option( 'alpha_installed', false ) ) {
				return;
			}

			// Check if already in the process of installing.
			if ( 'yes' === get_transient( 'alpha_installing' ) ) {
				return;
			}

			// If we made it till here nothing is running yet, lets set the transient now.
			set_transient( 'alpha_installing', 'yes', MINUTE_IN_SECONDS * 10 );

			! defined( 'ALPHA_INSTALLING' ) && define( 'ALPHA_INSTALLING', true );

			self::create_tables();

			delete_transient( 'alpha_installing' );
			update_option( 'alpha_installing', true );
		}

		/**
		 * Create table which the plugin will need to function;
		 */
		private static function create_tables() {
			global $wpdb;

			$wpdb->hide_errors();
			$table_name = $wpdb->prefix . 'alpha';

			// Check if table already exists.
			$table_exists = $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) === $table_name;

			if ( ! $table_exists ) {
				$collate = '';

				if ( $wpdb->has_cap( 'collation' ) ) {
					$collate = $wpdb->get_charset_collate();
				}

				require_once ABSPATH . 'wp-admin/includes/upgrade.php';

				$table_name      = $wpdb->prefix . 'alpha';
				$charset_collate = $collate;
				$sql             = "CREATE TABLE IF NOT EXISTS $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					fullname varchar(50) NOT NULL,
					email varchar(50) NOT NULL,
					phone varchar(50) NOT NULL,
					gender varchar(50) NOT NULL,
					user_bio text NOT NULL,
					employment_status varchar(50) NOT NULL,
					picture varchar(50) NOT NULL,
					created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
					PRIMARY KEY  (id)
				) $charset_collate;";

				dbDelta( $sql );
			}
		}

	}
}

Install::init();
