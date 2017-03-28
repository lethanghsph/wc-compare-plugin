<?php
/**
 * Plugin Name: WooCommerce Compare
 * Plugin URI:  https://github.com/lethanghsph/wc-compare-plugin
 * Description: Compare products WooCommerce.
 * Version:     1.0.0
 * Author:      ThangLe
 * Author URI:  https://github.com/lethanghsph
 * Text Domain: compare
 * Domain Path: /languages
 * License:     GPL2
 *
 * @package Compare
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Compare' ) ) {
	exit;
}

/**
 * Main Compare class.
 *
 * @class Compare.
 * @version 1.0.0
 */
final class Compare {

	/**
	 * Compare version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * This single instnace of theclass.
	 *
	 * @var Compare
	 */
	protected static $_instance = null;

	/**
	 * Main Compare instance.
	 */
	public static function get_instance() {
		if ( null === self::$_instance ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Compare Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'compare_loaded' );
	}

	/**
	 * Define Compare Constants.
	 */
	private function define_constants() {
		$this->define( 'CP_PLUGIN_FILE', __FILE__ );
		$this->define( 'CP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'CP_VERSION', $this->version );
		$this->define( 'COMPARE_VERSION', $this->version );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	private function includes() {
		include_once( 'includes/class-wc-install.php' );
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hook() {
		register_activation_hook( __FILE__, array( 'CP_Install', 'install' ) );
	}

	/**
	 * Define constants if not already set.
	 *
	 * @param  [string]        $name  [name].
	 * @param  [string|boolen] $value [value].
	 */
	public function define_const( $name, $value ) {
		defined( $name ) or define( $name, $value );
	}
}
