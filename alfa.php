<?php
/**
 * Plugin Name: Alpha
 * Plugin URI: https://wprdpress.org/plugins
 * Description: Alpha Plugin For CRUD operation WordPress.
 * Version: 1.0.0
 * Author: Som Shrestha
 * Author URI:
 * Text Domain: alpha
 * Domain Path: /languages/
 *
 * Copyright: © 2023 Som.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package Alpha
 */

/* It prevents public user to directly access your .php files through URL.
If your file contains some I/O operations it can eventually be triggered (by an attacker)
and this might cause unexpected behavior.
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
} else {
	add_action(
		'admin_notices',
		function () {
			?>
			<div class="notice notice-error">
				<p><?php esc_html_e( 'Please run composer install in your plugin directory.', 'alpha' ); ?></p>
			</div>
			<?php
		}
	);
}

/**
 * Define the plugin version constant.
 * It will be used throughout the plugin.
 */

if ( ! defined( 'ALPHA_PLUGIN_VERSION' ) ) {
	define( 'ALPHA_PLUGIN_VERSION', '1.0.0' );
}

// Define constant that provides full path and name of the plugin's main file.
if ( ! defined( 'ALPHA_PLUGIN_FILE' ) ) {
	define( 'ALPHA_PLUGIN_FILE', __FILE__ );
}
