<?php
/**
 * Declaring widgets
 *
 * @package hapje-2017
 */

if ( ! function_exists( 'hapje_2017_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function hapje_2017_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Header Full', 'hapje-2017' ),
			'id'            => 'headerfull',
			'description'   => 'Widgets above content, under menu',
		    'before_widget'  => '<div id="%1$s" class="header-widget %2$s">',
		    'after_widget'   => '</div><!-- .footer-widget -->', 
		    'before_title'   => '<h3 class="widget-title">', 
		    'after_title'    => '</h3>', 
		) );

	}
} // endif function_exists( 'hapje-2017_widgets_init' ).
add_action( 'widgets_init', 'hapje_2017_widgets_init' );

