<?php
/**
 * silicodevalley_acf_wp_theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage silicodevalley_acf_wp_theme
 * @since silicodevalley_acf_wp_theme Theme 1.0
 */

//  Code is Poetry

/**
 * Enqueue scripts and styles.
 */
function silicodevalley_acf_wp_theme_scripts() {
	wp_enqueue_style( 'silicodevalley_acf_wp_theme-style', get_stylesheet_uri() );

    wp_enqueue_script( 'silicodevalley_acf_wp_theme-uikitjs', get_template_directory_uri() . '/js/uikit.min.js' );
    
	wp_enqueue_script( 'silicodevalley_acf_wp_theme-uikiticonsjs', get_template_directory_uri() . '/js/uikit-icons.min.js' );

	wp_enqueue_style( 'silicodevalley_acf_wp_theme-customcss', get_template_directory_uri() . '/css/custom.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'silicodevalley_acf_wp_theme_scripts' );
/**
 * Enqueue scripts and styles.
 */

/**
 * Theme Supports
 */

function custom_theme_features()  {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 150,
		'flex-width'  => true,
		'flex-height' => true,
	) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'align-wide' );
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'editor-styles' );
	add_editor_style( '/css/editor.css' );
}
add_action( 'after_setup_theme', 'custom_theme_features' );


 /*--------------------------------------*/
/* Add support for custom color palettes in Gutenberg.
/*--------------------------------------*/
require get_template_directory() . '/inc/color-palette.php';

/*--------------------------------------*/
/* Disable Custom Colors and Gradients
/*--------------------------------------*/
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'editor-gradient-presets', array() );
add_theme_support( 'disable-custom-gradients' );


/**
 * Declaration menus
 */
add_action('init', 'silicodevalley_acf_wp_theme_menus');
function silicodevalley_acf_wp_theme_menus() {
	register_nav_menus( array(
		'main_menu' => 'Menú principal',
		)
	);
	register_nav_menus( array(
		'mobile_menu' => 'Menú Mobile',
		)
	);
}

/**
 * Menú Walkers
 */
class silicodevalley_acf_wp_theme_top_menu extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<div class=\"uk-navbar-dropdown\">\n<ul role=\"menu\" class=\"uk-nav uk-navbar-dropdown-nav\">\n";
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent</ul></div>";
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';


		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		if ( $args->has_children )
			$class_names .= ' uk-parent';

		$dropdown = ''; 

		if ( in_array( 'current-menu-item', $classes ) || in_array('current-menu-parent', $classes))
			$class_names .= ' uk-active';

		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $dropdown . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->title )	? $item->title	: '';
		$atts['target'] = ! empty( $item->target )	? $item->target	: '';
		$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

		// If item has_children add atts to a.
		if ( $args->has_children && $depth === 0 ) {
			$atts['href']          = $item->url;
			// $atts['data-toggle']   = 'dropdown';
			// $atts['class']         = 'dropdown-toggle';
			// $atts['aria-haspopup'] = 'true';
		} else {
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $args->has_children && 0 === $depth ) ? '</a>' : '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';
            
			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">'. __('Add a menu', 'your themename') .'</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}

class silicodevalley_acf_wp_theme_offcanvas_menu extends Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\"uk-nav-sub\">\n";
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		if ( $args->has_children )
			$class_names .= ' uk-parent';


		if ( in_array( 'current-menu-item', $classes )  || in_array('current-menu-parent', $classes))
			$class_names .= ' uk-active';

		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li ' . $id . $value . $class_names . '>';

		$atts = array();
		$atts['title']  = ! empty( $item->title )	? $item->title	: '';
		$atts['target'] = ! empty( $item->target )	? $item->target	: '';
		$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

		// If item has_children add atts to a.
		if ( $args->has_children && $depth === 0 ) {
			$atts['href']          = $item->url;
			// $atts['data-toggle']   = 'dropdown';
			// $atts['class']         = 'dropdown-toggle';
			// $atts['aria-haspopup'] = 'true';
		} else {
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
		}

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;

		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">'. __('Add a menu', 'your themename') .'</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo $fb_output;
		}
	}
}

function silicodevalley_acf_wp_theme_widgets() {
	register_sidebar( array(
		'name'          => 'Superior contenido',
		'id'            => 'superior-contenido',
		'description'   => 'Coloca widgets que aparecerán en la zona superior del contenido principal.',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	register_sidebar( array(
		'name'          => 'Inferior contenido',
		'id'            => 'inferior-contenido',
		'description'   => 'Coloca widgets que aparecerán en la zona inferior del contenido principal.',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	
}
add_action( 'widgets_init', 'silicodevalley_acf_wp_theme_widgets' );