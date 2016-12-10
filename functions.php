<?php

define( 'THEME_OPTIONS', 'rto_theme_options' );

/**
 *
 * @author: Mike Jakobsen
 *
 * Class Functions
 */
class Functions {

	/**
	 * @var string - The name of the theme.
	 */
	private $theme_name;

	/**
	 * @var string - The version of the theme.
	 */
	private $theme_version;

	/**
	 * Functions constructor.
	 *
	 * @param $theme_name
	 * @param $theme_version
	 */
	public function __construct( $theme_name, $theme_version ) {
		$this->theme_name    = $theme_name;
		$this->theme_version = $theme_version;
	}

	/**
	 * Global function called from the constructor
	 */
	public function theme_setup() {
		$this->require_dependencies();
		add_action( 'init', array( $this, 'register_post_thumbnails' ) );
		add_action( 'init', array( $this, 'register_theme_settings' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_fonts' ) );
		add_action( 'admin_init', array( $this, 'hide_dashboard_meta' ) );
		// add_action( 'admin_bar_menu', array( $this, 'hide_admin_bar_items' ), 999 );
		// add_action( 'admin_menu', array( $this, 'remove_admin_pages' ) );
		add_action( 'widgets_init', array( $this, 'register_sidebar' ) );
		add_action( 'widgets_init', array( $this, 'unregister_widgets' ), 11 );

		add_filter( 'admin_footer_text', array( $this, 'custom_dashboard_footer' ) );
	}

	/**
	 * Requires theme dependencies
	 */
	public function require_dependencies() {

		/**
		 * Bootstrap Navwalker
		 */
		require_once( 'inc/bootstrap_navwalker/wp_bootstrap_navwalker.php' );

		/**
		 * Theme Settings
		 */
		require_once( 'inc/theme_settings/theme_settings.php' );

	}

	/**
	 *  Enqueues stylesheets
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->theme_name . '_main_css', get_template_directory_uri() . '/dist/css/main.min.css', array(), $this->theme_version );
		wp_enqueue_style( $this->theme_name . '_style_css', get_template_directory_uri() . '/style.css', array(), $this->theme_version );
	}

	/**
	 *  Enqueues scripts
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->theme_name . '_bootstrap_js', get_template_directory_uri() . '/bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js', array( 'jquery' ), $this->theme_version );
	}

	/**
	 *  Enqueues fonts
	 */
	public function enqueue_fonts() {
		wp_enqueue_style( $this->theme_name . '_font_headings', 'https://fonts.googleapis.com/css?family=Arimo:300,400,700', array(), $this->theme_version );
		wp_enqueue_style( $this->theme_name . '_font_base', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700', array(), $this->theme_version );
		wp_enqueue_style( $this->theme_name . '_font_menu', 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300', array(), $this->theme_version );
	}

	/**
	 * Hides unnecessary admin pages from the dashboard menu
	 */
	public function hide_admin_pages() {
		remove_menu_page( 'users.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'edit-comments.php' );
		remove_menu_page( 'themes.php' );
		remove_menu_page( 'plugins.php' );
		remove_menu_page( 'options-general.php' );
		remove_menu_page( 'wpcf7' );
		remove_menu_page( 'Wordfence' );
		remove_menu_page( 'edit.php?post_type=acf-field-group' );
	}

	/**
	 * Hides unnecessary admin bar items
	 *
	 * @param $wp_admin_bar Object The admin bar
	 */
	public function hide_admin_bar_items( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'wp-logo' );
		$wp_admin_bar->remove_node( 'dashboard' );
		$wp_admin_bar->remove_node( 'themes' );
		$wp_admin_bar->remove_node( 'customize-themes' );
		$wp_admin_bar->remove_node( 'widgets' );
		$wp_admin_bar->remove_node( 'background' );
		$wp_admin_bar->remove_node( 'header' );
		$wp_admin_bar->remove_node( 'view-site' );
		$wp_admin_bar->remove_node( 'menus' );
		$wp_admin_bar->remove_node( 'new-content' );
		$wp_admin_bar->remove_node( 'comments' );
		$wp_admin_bar->remove_node( 'customize' );
		$wp_admin_bar->remove_node( 'search' );
		$wp_admin_bar->remove_node( 'user-actions' );
	}

	/**
	 * Hides unnecessary meta boxes from the dashboard.
	 */
	public function hide_dashboard_meta() {
		remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
		remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
		remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
		remove_meta_box( 'wordfence_activity_report_widget', 'dashboard', 'normal' );
	}

	public function custom_dashboard_footer() {
		echo 'RTO Klinik | <a href="www.mikejakobsen.com">Mike Jakobsen</a>';
	}

	/**
	 *  Registers support for post thumbnails and adds sizes
	 */
	public function register_post_thumbnails() {
		add_theme_support( 'post-thumbnails' );
		add_image_size( $this->theme_name . '_thumbnail', 150, 150, array( 'center', 'center' ) );
		add_image_size( $this->theme_name . '_small', 360, 250, array( 'center', 'center' ) );
		add_image_size( $this->theme_name . '_medium', 720, 500, array( 'center', 'center' ) );
		add_image_size( $this->theme_name . '_large', 1200, 830, array( 'center', 'center' ) );
		add_image_size( $this->theme_name . '_full', 360, 250, array( 'center', 'center' ) );
	}

	/**
	 * Registers navigation menus
	 */
	public function register_navigation_menus() {
		register_nav_menus( array(
			'primary' => 'Primary Menu',
			'sidebar'  => 'Primary Menu'
		) );
	}

	/**
	 * Registers theme settings
	 */
	public function register_theme_settings() {
		$theme_settings = new Theme_Settings();
	}

	/**
	 * Registers the main sidebar
	 */
	public function register_sidebar() {
		register_sidebar( array(
			'name'          => 'Sidebar',
			'id'            => 'sidebar_main',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		) );
	}

	/**
	 * Unregister default widgets that we don't want to support
	 */
	public function unregister_widgets() {
		unregister_widget( 'WP_Widget_Calendar' );
		unregister_widget( 'WP_Widget_Meta' );
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');
		unregister_widget('WP_Widget_Recent_Comments');
	}

}

/**
 *  Create an instance of our functions class
 */
$functions = new Functions( 'rto-theme', '1.0' );
$functions->theme_setup();

function my_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <button type="submit" id="searchsubmit"><i class="fa fa-fw fa-search"></i></button>
    </div>
    </form>';

	return $form;
}

add_filter( 'get_search_form', 'my_search_form', 100 );

/**
 * Extend Menu
 */
class child_menu {

	// Variables
	private $_menu_items = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		// Initialize plugin
		add_action( 'init', array( $this, 'init' ), 1 );
	}

	/**
	 * Initializes the plugin
	 */
	public function init() {
		// Add filters
		add_filter( 'wp_nav_menu_objects', array( $this, 'wp_nav_menu_objects' ), 10, 2 );
	}

	/**
	 * Extends the default function
	 *
	 * @param array   $sorted_menu_items
	 * @param object  $args
	 * @return array
	 */
	public function wp_nav_menu_objects( $sorted_menu_items, $args ) {
		// Add additional args
		if ( ! isset( $args->level ) )
			$args->level = 0;
		if ( ! isset( $args->papa ) )
			$args->papa = '';

		// Check if we need to do anything
		if ( ! $sorted_menu_items || ( $args->level == 0 && $args->papa == '' ) )
			return $sorted_menu_items;

		// Build a tree
		$this->_menu_items = $sorted_menu_items;
		$temp_array = array();
		foreach ( $this->_menu_items as $item ) {
			$temp_array[ $item->menu_item_parent ][] = $item;
		}
		$tree = $this->build_items_tree( $temp_array, $temp_array[0] );

		// Prepare updated items
		$updated_items = $this->get_level_items( $tree, $args->level, $args->papa );

		// Start array keys from 1
		$updated_items = array_filter( array_merge( array( 0 ), $updated_items ) );

		// Return updated items
		return $updated_items;
	}

	/**
	 * Builds a tree of menu items recursively
	 *
	 * @param  array  $list
	 * @param  object $parent
	 * @return array
	 */
	private function build_items_tree( &$list, $parent, $level = 1 ) {
		$tree = array();

		foreach ( $parent as $k => $l ) {
			if ( isset( $list[ $l->ID ] ) )
				$l->children = $this->build_items_tree( $list, $list[ $l->ID ], $level + 1 );

			$l->level = $level;
			$tree[] = $l;
		}

		return $tree;
	}

	/**
	 * Gets items from a particular level
	 * 'papa' => 'Submenu of'
	 *
	 * @param  array   $tree
	 * @param  integer $level
	 * @param  string  $papa
	 * @return array
	 */
	private function get_level_items( $tree, $level = 1, $papa = '' ) {
		$items = array();

		foreach ( $tree as $item ) {
			$papa_flag = false;

			if ( $papa != '' ) {
				if ( gettype( $papa ) == 'integer' && $item->menu_item_parent != $papa )
					$papa_flag = true;
				elseif ( gettype( $papa ) == 'string' && $item->menu_item_parent != $this->get_menu_id_from_title( $papa ) )
					$papa_flag = true;
			}

			if ( $item->level == $level && ! $papa_flag ) {
				unset( $item->children );
				$items[] = $item;
			}

			if ( isset( $item->children ) && $item->children )
				$items = $items + $this->get_level_items( $item->children, $level, $papa );
		}

		return $items;
	}

	/**
	 * Gets a menu ID based on the title of the item
	 * Capturing the depth
	 *
	 * @param  string $name
	 * @return string
	 */
	private function get_menu_id_from_title( $name = '' ) {
		foreach ( $this->_menu_items as $item ) {
			if ( $item->title == $name )
				return $item->ID;
		}

		return '';
	}

}

// New instance
new child_menu();
