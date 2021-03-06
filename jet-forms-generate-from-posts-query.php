<?php
/**
 * Plugin Name: JetForms - Generate options from Query Builder query
 * Plugin URI:
 * Description: Allows to get form options from Query Builder query
 * Version:     1.0.0
 * Author:      
 * Author URI:  
 * Text Domain: jet-forms-generate-from-posts-query
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_action( 'plugins_loaded', function () {
	if ( function_exists( 'jet_engine' ) ) {
		define( 'JET_GFQ__FILE__', __FILE__ );
		define( 'JET_GFQ_PLUGIN_BASE', plugin_basename( JET_GFQ__FILE__ ) );
		define( 'JET_GFQ_PATH', plugin_dir_path( JET_GFQ__FILE__ ) );

		add_filter( 'jet-engine/forms/options-generators', function( $instances ) {
			require JET_GFQ_PATH . 'generator.php';
			$instances[] = new Jet_Forms_Posts_Query_Generator();
			return $instances;
		} );

		add_filter( 'jet-form-builder/forms/options-generators', function ( $instances ) {
			require JET_GFQ_PATH . 'jet-fb-generator.php';
			$instances[] = new Jet_Fb_Posts_Query_Generator();
			return $instances;
		} );
	}
} );

