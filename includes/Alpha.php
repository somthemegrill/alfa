<?php
/**
 * Alpha setup
 *
 * @package Alpha
 * @since 1.0.0
 */

namespace Alpha;

use Alpha\Admin\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( ! class_exists( 'Alpha' ) ) :

	final class Alpha {

		/**
		 *  Instance of the class.
		 * @var object
		 */
		protected static $instance = null;

		/**
		 *  Instance of Install Class.
		 *
		 * @return object
		 */
		public $install = null;

		/**
		 *  Initialize the Admin Class.
		 * @return object
		 */
		public $admin = null;

		/**
		 *  Admin class instance
		 *
		 * @return object
		 */
		public static function get_instance() {
			// If the single instance hasn't been set, set it now.
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor for the class
		 * @since 1.0.0
		 */

		private function __construct() {
			require 'CoreFunction.php';
			// Check if the plugin is compatible with the current version of WordPress and PHP.
			add_action( 'admin_notices', 'alpha_check_compatibility' );
			// Plugin activation and deactivation hooks.
			add_filter( 'plugin_action_links_' . plugin_basename( ALPHA_PLUGIN_FILE ), array( $this, 'plugin_action_links' ) );
			add_action( 'init', array( $this, 'includes' ) );

			// Register activation hook.
//			register_activation_hook( __FILE__, array( 'Install', 'install' ) );
		}

		/**
		 *  Include the files.
		 */

		public function includes() {

			$this->install = new Install();

			// Check if is admin or not and load correct class
			if ( $this->is_admin() ) {
				$this->admin = new Admin();
			}
		}

		/*
		 * Check if is admin or not and load correct class
		 *
		 * @return boolean
		 * @since 1.0.0
		 */

		public function is_admin() {
			$check_ajax    = defined( 'DOING_AJAX' ) && DOING_AJAX;
			$check_context = isset( $_REQUEST['context'] ) && $_REQUEST['context'] == 'frontend';

			return is_admin() && ! ( $check_ajax && $check_context );
		}

		/*
		 * Display action links in the plugin list table.
		 *
		 * @param array $actions Add plugin action links.
		 *
		 * @return array
		 */

		public function plugin_action_links( $actions ) {
			$new_actions = array(
				'settings' => '<a href="' . admin_url( 'admin.php?page=alpha-form' ) . '" title="' . esc_attr( __( 'View Alpha Settings', 'alpha' ) ) . '">' . __( 'Settings', 'alpha' ) . '</a>',
			);
			return array_merge( $new_actions, $actions );
		}

		/**
		 * Get the plugin url.
		 *
		 * @param string $path
		 */

		public function plugin_url() {
			return untrailingslashit( plugins_url( '/', ALPHA_PLUGIN_FILE ) );
		}


	}

endif;
