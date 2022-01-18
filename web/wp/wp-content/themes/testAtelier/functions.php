<?php 

function montheme_support()
{
    add_theme_support('title-tag');
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'menus' );
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    register_nav_menu('front-page', 'Navigation aide');
    add_image_size('card-header', 350, 215, true);

}

function montheme_register_assets()
{
    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css');
    wp_register_style('owlcarousel',  get_stylesheet_directory_uri() . '/owl.carousel.min.css');
    wp_register_style('themedefault', get_stylesheet_directory_uri() . '/owl.theme.default.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.0.js', [], false, true);
    wp_register_script('jquery', 'jquery.min.js');
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('owlcarousel');
    wp_enqueue_style('themedefault');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('jquery');
    wp_enqueue_style( 'style', get_stylesheet_uri() );
}


function montheme_title_separator()
{
    return '|';
}

function montheme_document_title_parts($title)
{
    unset($title['tagline']);
    return $title;
}


function montheme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}
function montheme_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function my_wp_nav_menu_items( $items, $args ) {
	
	$menu = wp_get_nav_menu_object($args->menu);
	
	if( $args->theme_location == 'header' ) {

		$logo = get_field('logo', $menu);
		$color = get_field('color', $menu);
		
        $html_logo = '<li class="menu-item-logo"><a href="'.home_url().'"><img src="'.$logo['url'].'" alt="'.$logo['alt'].'" /></a></li>';		
		
		$html_color = '<style type="text/css">.navigation-top{ background: '.$color.';}</style>';	

		$items = $html_logo . $items . $html_color;
		
	}
	
	return $items;
}

add_action('after_setup_theme', '\montheme_support');
add_action('wp_enqueue_scripts', '\montheme_register_assets');
add_filter('document_title_separator', '\montheme_title_separator');
add_filter('document_title_parts', '\montheme_document_title_parts');
add_filter('nav_menu_css_class', '\montheme_menu_class');
add_filter('nav_menu_link_attributes', '\montheme_link_class');
add_filter('wp_nav_menu_items', '\my_wp_nav_menu_items', 10, 2);

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_script('owl-caroussel', get_stylesheet_directory_uri() . '/assets/js/owl.carousel.min.js', [], null, true);
});
add_action('wp_enqueue_scripts', function() {
	wp_enqueue_script('app', get_stylesheet_directory_uri() . '/assets/js/app.js', [], null, true);
});

// ====================== autocomplete.js =================================================================

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_script('autocomplete-search', get_stylesheet_directory_uri() . '/assets/js/autocomplete.js', 
		['jquery', 'jquery-ui-autocomplete'], null, true);
	wp_localize_script('autocomplete-search', 'AutocompleteSearch', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'ajax_nonce' => wp_create_nonce('autocompleteSearchNonce')
	]);
 
	$wp_scripts = wp_scripts();
	wp_enqueue_style('jquery-ui-css',
        '//ajax.googleapis.com/ajax/libs/jqueryui/' . $wp_scripts->registered['jquery-ui-autocomplete']->ver . '/themes/smoothness/jquery-ui.css',
        false, null, false
   	);
});
 
add_action('wp_ajax_nopriv_autocompleteSearch', 'awp_autocomplete_search');
add_action('wp_ajax_autocompleteSearch', 'awp_autocomplete_search');
function awp_autocomplete_search() {
	check_ajax_referer('autocompleteSearchNonce', 'security');
 
	$search_term = $_REQUEST['term'];
	if (!isset($_REQUEST['term'])) {
		echo json_encode([]);
	}
 
	$suggestions = [];

	$query = new WP_Query([
		's' => $search_term,
		'posts_per_page' => -1,
	]);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$suggestions[] = [
				'id' => get_the_ID(),
				'label' => get_the_title(),
				'link' => get_the_permalink()
			];
		}
		wp_reset_postdata();
	}
	echo json_encode($suggestions);
	wp_die();
};


//  =================================================================================================

//  ======================= BLOCKS ===================================================================

add_filter('block_categories_all', function($categories){
	$categories[] = [
		'slug' => 'theme',
		'title' => 'Theme',
		'icon' => null
	];
	return $categories;
});


if (function_exists('acf_register_block_type')) {
	add_action('acf/init', function ()
	{
		acf_register_block_type([
			'name' => 'highlighted_posts',
			'title' => 'Articles mis en avant',
			'render_callback' => function()
			{
				echo '<h2>' . get_field('titre-section3') . '</h2>';
			},
			'category' => 'theme'
		]);
	});
}

