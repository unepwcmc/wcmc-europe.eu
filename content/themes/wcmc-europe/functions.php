<?php

/*-------------------------------------------------------------------------------------------------
Remove About Us
------------------------------------------------------------------------------------------------- */

function change_toolbar($wp_toolbar)
{
	$wp_toolbar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'change_toolbar', 999);

/*-------------------------------------------------------------------------------------------------
  Remove Categories and Tags from default WP Posts
------------------------------------------------------------------------------------------------- */

function myprefix_remove_tax()
{
	register_taxonomy('post_tag', array());
	register_taxonomy('post_format', array());
}
add_action('init', 'myprefix_remove_tax');

/*-------------------------------------------------------------------------------
Gutenberg Colour Pallet
-------------------------------------------------------------------------------*/

// -- Disable Colors
add_theme_support('editor-color-palette', array());
add_theme_support('disable-custom-colors');


/*-------------------------------------------------------------------------------------------------
SHOW ADMIN FOR EDITOR
------------------------------------------------------------------------------------------------- */

if (!current_user_can('edit_posts')) {
	add_filter('show_admin_bar', '__return_false');
}

/*-------------------------------------------------------------------------------------------------
SETUP THEME
------------------------------------------------------------------------------------------------- */

add_action('after_setup_theme', 'custom_setup');


if (!function_exists('custom_setup')) {

	function custom_setup()
	{

		global $wp_version, $wpdb;

		// Add styles for the visual editor
		add_editor_style();

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support('automatic-feed-links');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu('main', __('Main Menu', 'custom'));
		register_nav_menu('mobile', __('Mobile Menu', 'custom'));
		register_nav_menu('footer', __('Footer Menu', 'custom'));
		register_nav_menu('social', __('Social Menu', 'custom'));

		// Add support for Featured Images
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(250, 250, true);
		add_image_size('banner', 1920, 456, true); // Banner Image
		add_image_size('featured', 500, 350, true); // Featured Image
		add_image_size('small-featured', 400, 260, true); // Featured Image
		add_image_size('logo', 300, 300, false); // Featured Image
		add_image_size('featured-portrait', 350, 500, true); // Featured Image

		// Disable default gallery css styles
		add_filter('use_default_gallery_style', '__return_false');

		if (!is_admin()) {
			add_action('wp_enqueue_scripts', 'custom_load_js');
		}
	}
}

/*-------------------------------------------------------------------------------------------------
LOAD STYLES
------------------------------------------------------------------------------------------------- */

function custom_styles()
{
	wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap');
	wp_enqueue_style('flickity', 'https://unpkg.com/flickity@2/dist/flickity.min.css');
	wp_enqueue_style('main_css', get_stylesheet_directory_uri() . '/dist/build/css/main.css');
	wp_enqueue_style('ie_css', get_stylesheet_directory_uri() . '/dist/build/css/ie.css');
}

add_action('wp_enqueue_scripts', 'custom_styles');

/*-------------------------------------------------------------------------------------------------
LOAD BLOCK EDITOR STYLES
------------------------------------------------------------------------------------------------- */

function custom_block_editor_styles()
{
	wp_enqueue_style('main_css', get_stylesheet_directory_uri() . "/dist/build/css/main.css", false, '1.0', 'all');
}

add_action('enqueue_block_editor_assets', 'custom_block_editor_styles');

/*-------------------------------------------------------------------------------------------------
LOAD JS
------------------------------------------------------------------------------------------------- */

function custom_load_js()
{
	// Enqueue Javascript
	if (!is_admin()) {
		wp_enqueue_script('polyfill_js', 'https://cdn.polyfill.io/v2/polyfill.min.js?features=Promise,fetch,Symbol,Array.prototype.@@iterator,Element.prototype.classList,Object.values,Object.entries,IntersectionObserver', '', '', true);
		wp_enqueue_script('vendor_js', get_template_directory_uri() . '/dist/build/js/vendor.js', '', '', true);
		wp_enqueue_script('theme_js', get_template_directory_uri() . '/dist/build/js/app.js', array('vendor_js'), '', true);
	}
}

/*-------------------------------------------------------------------------------------------------
SIDEBARS
------------------------------------------------------------------------------------------------- */

function custom_register_sidebar()
{

	register_sidebar(array(
		'name' => __('Sidebar', 'custom'),
		'id' => 'sidebar',
		'before_widget' => '<li class="sbr-Widgets_Item"><div class="sbr-Widget sbr-Widget-%1$s sbr-Widget-%2$s">',
		'after_widget' => "</div></li>",
		'before_title' => '<h3 class="sbr-Widget_Title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Header', 'custom'),
		'id' => 'header',
		'before_widget' => '<div class="hd-Widgets_Item"><aside class="hd-Widget hd-Widget-%1$s hd-Widget-%2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="hd-Widget_Title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('After Content', 'custom'),
		'id' => 'after-content',
		'before_widget' => '<div class="wgt-Widgets_Item"><aside class="wgt-Widget wgt-Widget-%1$s wgt-Widget-%2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="wgt-Widget_Title">',
		'after_title' => '</h3>'
	));

	register_sidebar(array(
		'name' => __('Footer', 'custom'),
		'id' => 'footer',
		'before_widget' => '<div class="ft-Widgets_Item ft-Widgets_Item-%1$s ft-Widgets_Item-%2$s"><aside class="ft-Widget ft-Widget-%1$s ft-Widget-%2$s">',
		'after_widget' => "</aside></div>",
		'before_title' => '<h3 class="ft-Widget_Title">',
		'after_title' => '</h3>'
	));
}

add_action('widgets_init', 'custom_register_sidebar');

/*-------------------------------------------------------------------------------
ADD SUB PAGES
-------------------------------------------------------------------------------*/

// add hook
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2);

// filter_hook function to react on sub_menu flag
function my_wp_nav_menu_objects_sub_menu($sorted_menu_items, $args)
{
	if (isset($args->sub_menu)) {
		$root_id = 0;
		// find the current menu item
		foreach ($sorted_menu_items as $menu_item) {
			if ($menu_item->current) {
				// set the root id based on whether the current menu item has a parent or not
				$root_id = ($menu_item->menu_item_parent) ? $menu_item->menu_item_parent : $menu_item->ID;
				break;
			}
		}
		// find the top level parent
		if (!isset($args->direct_parent)) {
			$prev_root_id = $root_id;
			while ($prev_root_id != 0) {
				foreach ($sorted_menu_items as $menu_item) {
					if ($menu_item->ID == $prev_root_id) {
						$prev_root_id = $menu_item->menu_item_parent;
						// don't set the root_id to 0 if we've reached the top of the menu
						if ($prev_root_id != 0) $root_id = $menu_item->menu_item_parent;
						break;
					}
				}
			}
		}
		$menu_item_parents = array();
		foreach ($sorted_menu_items as $key => $item) {
			// init menu_item_parents
			if ($item->ID == $root_id) $menu_item_parents[] = $item->ID;

			if (in_array($item->menu_item_parent, $menu_item_parents)) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} else if (!(isset($args->show_parent) && in_array($item->ID, $menu_item_parents))) {
				// not part of sub-tree: away with it!
				unset($sorted_menu_items[$key]);
			}
		}
		return $sorted_menu_items;
	} else {
		return $sorted_menu_items;
	}
}

// Enable shortcodes in text widgets
add_filter('widget_text', 'do_shortcode');

// Nuepress functions

// Added to end of the post excerpt if longer than 55 words
function new_excerpt_more($more)
{
	return '…';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Increase max page limit
function increase_per_page_limit($params)
{
	if (isset($params['per_page'])) {
		$params['per_page']['maximum'] = 1000000;
	}
	return $params;
}

add_filter('rest_post_collection_params', 'increase_per_page_limit', 10, 2);
add_filter('rest_page_collection_params', 'increase_per_page_limit', 10, 2);
add_filter('rest_category_collection_params', 'increase_per_page_limit', 10, 2);
add_filter('rest_user_collection_params', 'increase_per_page_limit', 10, 2);

// Hide customize theme options
function remove_customize_theme_options($wp_customize)
{
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');
	$wp_customize->remove_section('background_image');
	// $wp_customize->remove_panel('nav_menus');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('custom_css');
}
add_action('customize_register', 'remove_customize_theme_options', 50);

// Remove comments from admin
function my_remove_admin_menus()
{
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'my_remove_admin_menus');

// Removes comment from admin bar
function mytheme_admin_bar_render()
{
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'mytheme_admin_bar_render');

// https://github.com/WordPress/gutenberg/issues/1761#issuecomment-412876340
add_filter('rest_url', function ($url) {
	$url = str_replace(home_url(), site_url(), $url);
	return $url;
});


// Return Gutenberg Blocks as JSON over WP REST API
add_action(
	'rest_api_init',
	function () {

		if (!function_exists('use_block_editor_for_post_type')) {
			require ABSPATH . 'wp-admin/includes/post.php';
		}

		// Surface all Gutenberg blocks in the WordPress REST API
		// https://wpscholar.com/blog/add-gutenberg-blocks-to-wp-rest-api/
		$post_types = get_post_types_by_support(['editor']);
		foreach ($post_types as $post_type) {
			if (use_block_editor_for_post_type($post_type)) {
				register_rest_field(
					$post_type,
					'gutenberg_blocks',
					[
						'get_callback' => function (array $post) {
							return parse_blocks($post['content']['raw']);
						},
					]
				);
			}
		}
	}
);


/**
 * IMPORT ACF OPTIONS PAGE SETTINGS
 */
require_once('acf-options-page.php');


/**
 * OVERWRITE ERRORING FUNCTIONS IN "wuxt-headless-wp-api-extensions" PLUGIN
 */
remove_action('rest_api_init', 'wuxt_front_page_route');
add_action('rest_api_init', 'wuxt_front_page_route_with_permission_callback', $priority = 10, $args = 0);

function wuxt_front_page_route_with_permission_callback()
{
	register_rest_route('wuxt', '/v1/front-page', array(
		'methods'  => 'GET',
		'callback' => 'wuxt_get_front_page',
		'permission_callback' => function () {
			return '__return_true';
		},
	));
}

remove_action('rest_api_init', 'wuxt_route_menu');
add_action('rest_api_init', 'wuxt_route_menu_with_permission_callback');

function wuxt_route_menu_with_permission_callback()
{
	register_rest_route('wuxt', '/v1/menu', array(
		'methods' => 'GET',
		'callback' => 'wuxt_get_menu',
		'permission_callback' => function () {
			return '__return_true';
		},
	));
}

remove_action('rest_api_init', 'wuxt_slug_route');
add_action('rest_api_init', 'wuxt_slug_route_with_permission_callback');

function wuxt_slug_route_with_permission_callback()
{
	register_rest_route('wuxt', '/v1/slug/(?P<slug>\S+)', array(
		'methods'  => 'GET',
		'callback' => 'wuxt_get_slug',
		'permission_callback' => function () {
			return '__return_true';
		},
	));
}
