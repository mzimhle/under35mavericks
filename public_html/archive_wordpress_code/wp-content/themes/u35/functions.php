<?php

/**

	Many tutorials suggest placing code in the functions.php file. This file
 	is used to configure the theme's framework. Editing may break your theme.

	Please use the custom-functions.php file for customization. Thanks! :)

**/

// Air Framework
$air = require( get_template_directory() . '/air/base/lib/air.php' );

/*---------------------------------------------------------------------------*/
/* WPBandit :: Air Framework Configuration
/*---------------------------------------------------------------------------*/

// Theme configuration
Air::mset(
	array(
		// Theme options
		'theme-options'		=> 'wpbandit-typegrid',

		// Text domain
		'text-domain'		=> 'typegrid',

		// Theme features
		'features' => array(
			'automatic-feed-links'	=> TRUE,
			'post-thumbnails'		=> TRUE,
			'post-formats'			=> array('audio','aside','chat','gallery','image','link','quote','status','video')
		),

		// Navigation menus
		'nav-menus' => array(
			'header'	=> 'Header',
			'subheader'	=> 'Subheader',
			'footer' 	=> 'Footer'
		),

		// Sidebars
		'sidebars' => array(
			array(
				'id'			=> 'sidebar-default',
				'name'			=> 'Default Sidebar',
				'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
				'after_widget'	=> '</li>',
				'before_title'	=> '<h3 class="widget-title group"><span>',
				'after_title'	=> '</span></h3>',
			)
		),

		// Widgets
		'widgets' => array(
			'widget-tabs' 	=> 'WPB_Widget_Tabs',
			'widget-video' 	=> 'WPB_Widget_Video'
		),

		// Image sizes
		'image-sizes' => array(
			array(
				'name'		=> 'size-format',
				'width'		=> 720,
				'height'	=> 0,
				'crop'		=> FALSE
			),
			array(
				'name'		=> 'size-thumbnail-tabs',
				'width'		=> 192,
				'height'	=> 128,
				'crop'		=> TRUE
			),
			array(
				'name'		=> 'size-thumbnail-medium',
				'width'		=> 520,
				'height'	=> 245,
				'crop'		=> TRUE
			),
			array(
				'name'		=> 'size-thumbnail-large',
				'width'		=> 720,
				'height'	=> 340,
				'crop'		=> TRUE
			),
		),

		// Styles
		'styles' => array(
			array(
				'handle'	=> 'wpbandit-custom',
				'src'		=> get_template_directory_uri().'/custom.css',
				'deps'		=> FALSE,
				'ver'		=> '1.0'
			),
			array(
				'handle'	=> 'style-responsive',
				'src'		=> get_template_directory_uri().'/style-responsive.css',
				'deps'		=> FALSE,
				'ver'		=> '1.0'
			),
			array(
			 	'handle'	=> 'font-awesome',
				'src'		=> get_template_directory_uri().'/fonts/font-awesome.min.css',
				'deps'		=> FALSE,
				'ver'		=> '3.0'
			)
		),

		// Javascript
		'scripts' => array(
			array(
			 	'handle'	=> 'flexslider',
				'src'		=> get_template_directory_uri().'/js/jquery.flexslider.min.js',
				'deps'		=> array('jquery'),
				'ver'		=> '2.1',
				'footer'	=> TRUE
			),
			array(
				'handle'	=> 'jplayer',
				'src'		=> get_template_directory_uri().'/js/jquery.jplayer.min.js',
				'ver'		=> '2.1.0',
				'footer'	=> TRUE
			),
			array(
				'handle'	=> 'sharrre',
				'src'		=> get_template_directory_uri().'/js/jquery.sharrre-1.3.4.min.js',
				'deps'		=> array('jquery'),
				'ver'		=> '1.3.4',
				'footer'	=> TRUE
			),
			array(
				'handle'	=> 'theme',
				'src'		=> get_template_directory_uri().'/js/jquery.theme.js',
				'deps'		=> array('jquery'),
				'ver'		=> '1.0',
				'footer'	=> TRUE
			),
		),

		// Meta files
		'meta-files' => array(
			'meta-general.php'
		),

		// Help tabs
		'help-tabs' => array(
			'faq'	=> 'FAQ'
		)
	)
);

// Set content width based on theme's design
if ( !isset( $content_width ) ) $content_width = 720;

/*---------------------------------------------------------------------------*/

// Add sections to theme options - slug, title
Air::add_options_menu_item('general','General');
Air::add_options_menu_item('blog','Blog');
Air::add_options_menu_item('seo','SEO');
Air::add_options_menu_item('header','Header');
Air::add_options_menu_item('sidebar','Sidebar');
Air::add_options_menu_item('footer','Footer');
Air::add_options_menu_item('styling','Styling');
Air::add_options_menu_item('javascript','JavaScript');

// Add modules
Air::add_module('login','Login');
Air::add_module('maintenance','Maintenance');
Air::add_module('sidebar','Sidebar');
Air::add_module('social','Social');
Air::add_module('breadcrumbs','Breadcrumbs');
Air::add_module('related-posts','Related Posts');

// Initialize framework
$air->run();
