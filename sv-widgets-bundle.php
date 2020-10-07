<?php
/*
Plugin Name: SocioVirtual Widgets para SiteOrigin
Plugin URI: https://github.com/vargasmolina/sv-widgets-bundle
Description: Socio Virtual Coleccion de Widget para SiteOrigin
Version: 	1.0.0
Author: 	Jose Vargas Molina
Author URI: https://sociovirtual.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: sv-widgets-bundle
Domain Path: /languages
*/

defined( 'ABSPATH' ) or die( esc_html_e( 'With great power comes great responsibility.', 'sv-widgets-bundle' ) );

class SocioVirtual_Widgets_Bundle {
	public function __construct() {
		// Enqueue Scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'sociovirtual_enqueue_scripts' ) );

		// Add widgets folder to SiteOrigin Widgets
		add_filter( 'siteorigin_widgets_widget_folders', array( $this, 'sociovirtual_widget_folders' ) );

	}

	public function sociovirtual_enqueue_scripts() {
		if ( ! is_admin() ) {
			// Widget CSS
			wp_register_style( 'sv-css', plugin_dir_url( __FILE__ ) . 'css/sv-css-widget.css' );
			wp_enqueue_style( 'sv-css' );

			// Owl Carousel JS
			// wp_register_script( 'rawb-owl-carousel-js', plugin_dir_url( __FILE__ ) . 'public/js/owl.carousel.min.js', array( 'jquery' ), null, true );

			// Widget JS
			// wp_register_script( 'rawb-widgets-js', plugin_dir_url( __FILE__ ) . 'public/js/widget.min.js', array( 'jquery' ), null, true );
		}
	}

	public function sociovirtual_widget_folders( $folders ) {
		$folders[] = plugin_dir_path( __FILE__ ) . 'widgets/';

		return $folders;
	}
}

new SocioVirtual_Widgets_Bundle();

########################### obtener layout
	class SocioVirtual_Widgets_Bundle_loop {
	public function get_layout_select_options() {
            
		$args = array(
			'post_type'=> 'echelonso_layout',
			'posts_per_page' => -1,
			'orderby' => 'post_title',
			'order' => 'ASC'
		);
		
		$the_query = new WP_Query( $args );
		
		$options = array();
		
		$options[0] = __('None', 'sv-widgets-bundle');
		
		if ( $the_query->have_posts() ) {
			foreach ($the_query->posts as $k => $v) {
				$options[$v->ID] = $v->post_title;
			}
		}
		
		return $options;
	}

}
global $svrl;
$svrl = new SocioVirtual_Widgets_Bundle_loop();


