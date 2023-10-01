<?php
/*
 * Alpha setup
 * @package Alpha\Admin
 * @since 1.0.0
 */

namespace Alpha\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Admin class
 * @since 1.0.0
 */
class Admin {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize hooks.
	 * @return void
	 * @since 1.0.0
	 */

	private function init_hooks() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Add admin menu.
	 * @return void
	 * @since 1.0.0
	 */

	public function admin_menu() {
		$template_page = add_menu_page(
			__( 'Alpha', 'alpha' ),
			__( 'Alpha', 'alpha' ),
			'manage_options',
			'alpha-form',
			array(
				$this,
				'alpha_setting_page',
			)
		);

		add_action( 'load-' . $template_page, array( $this, 'template_page_init' ) );
	}

	/**
	 * Loads screen options for admin page.
	 * @return void
	 * @since 1.0.0
	 */

	public function template_page_init() {

	}

	/**
	 *  Init the alpha setting page.
	 * @return void
	 * @since 1.0.0
	 */

	public function alpha_setting_page() {
		ob_start();
		echo '<h1>Alpha Setting</h1>';
		$contents = ob_get_clean();
		echo $contents;
	}
}
