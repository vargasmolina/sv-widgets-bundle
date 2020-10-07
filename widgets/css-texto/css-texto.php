<?php

/*
Widget Name: CSS-Texto
Description: Create texto con css
Author: SocioVirtual
Author URI: http://sociovirtual.com

*/

class SiteOrigin_Widget_Css_Texto extends SiteOrigin_Widget {
/* contructor basico 
https://siteorigin.com/docs/widgets-bundle/getting-started/creating-a-widget/
*/
	function __construct() {

		parent::__construct(
			'css-texto', // unico id
			__( 'Css-Texto', 'sv-widgets-bundle' ),
			array(
				'description' => __( 'Creacion Texto usando CSS ', 'sv-widgets-bundle' ),
				'panels_icon' => 'dashicons dashicons-editor-justify',
                // 'help'        => 'http://example.com/hello-world-widget-docs',
			),
			array(),
			false,
			plugin_dir_path( __FILE__ )
		);
	}
/* cerador de formulario 
https://siteorigin.com/docs/widgets-bundle/form-building/form-fields/
*/
	function get_widget_form() {
		return array(

			/* texto */			
			'texto_intro' => array(
				'type' => 'tinymce',
				'label' => __('Texto Intro', 'sv-widgets-bundle'),
				'description' => __('Texto de Introduccion', 'so-widgets-bundle'),
				'default' => 'Lorem ipsum dolor sit amet consectetur adipiscing elit, urna consequat felis vehicula class ultricies mollis dictumst, aenean non a in donec nulla. Phasellus ante pellentesque erat cum risus consequat imperdiet aliquam, integer placerat et turpis mi eros nec lobortis taciti, vehicula nisl litora tellus ligula porttitor metus. ',
				'rows' => 10
			),
			'custom_css' => array(
				'type' => 'text',
				'label' => __('custom CSS', 'sv-widgets-bundle'),
				'default' => __('Texto de Introduccion', 'sv-widgets-bundle'),
			),
			'autop' => array(
				'type' => 'checkbox',
				'default' => true,
				'label' => __( 'Agregar Automaticamente parafos', 'sv-widgets-bundle' ),
			),

		);
	}


	/**
	 * Get the template variables for the headline
	 *
	 * @param $instance
	 * @param $args
	 *
	 * @return array
	 */
	function get_template_variables( $instance, $args ) {

		return array(
			'texto' => ( $instance['autop'] ) ? wpautop( $instance['texto_intro'] ) : preg_replace('%<p(.*?)>|</p>%s','', $instance['texto_intro'] ) 
		);

	}

}

siteorigin_widget_register( 'css-texto', __FILE__, 'SiteOrigin_Widget_Css_Texto' );
