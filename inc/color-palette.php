<?php
/*--------------------------------------*/
/* Adding support for custom color palettes in Gutenberg.
/*--------------------------------------*/
function mspesp_wp_theme_gutenberg_color_palette() {
	add_theme_support(
		'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'Azul', 'mspesp_wp_theme' ),
				'slug' => 'azul',
				'color' => '#004482',
			),
			array(
				'name'  => esc_html__( 'Naranja', 'mspesp_wp_theme' ),
				'slug' => 'naranja',
				'color' => '#F9A23F',
			),
			array(
				'name'  => esc_html__( 'Gris', 'mspesp_wp_theme' ),
				'slug' => 'gris',
				'color' => '#606060',
			),
			array(
				'name'  => esc_html__( 'Gris claro', 'mspesp_wp_theme' ),
				'slug' => 'grisclaro',
				'color' => '#968f88',
			),
			array(
				'name'  => esc_html__( 'Gris mínimo', 'mspesp_wp_theme' ),
				'slug' => 'grisminimo',
				'color' => '#E6E8F2',
			),
			array(
				'name'  => esc_html__( 'Blanco', 'mspesp_wp_theme' ),
				'slug' => 'blanco',
				'color' => '#ffffff',
			),
		)
	);
}
add_action( 'after_setup_theme', 'mspesp_wp_theme_gutenberg_color_palette' );
?>