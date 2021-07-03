<?php

// Load common theme actions, functions, and filters
require ( AIR_THEME .'/theme-common.php');

// Custom TinyMCE button
require ( AIR_THEME . '/theme-tinymce.php');

/*---------------------------------------------------------------------------*/
/* Theme :: Setup + Actions
/*---------------------------------------------------------------------------*/

// Add admin actions
add_action( 'air_validate_theme_options', 'wpbandit_advanced_css', 10, 2 );

// Add theme actions
add_action( 'after_setup_theme', 'wpbandit_setup_theme' );
add_action( 'widgets_init', 'wpbandit_widgets_init' );
add_action( 'wp_enqueue_scripts', 'wpbandit_styles' );
add_action( 'wp_enqueue_scripts', 'wpbandit_scripts' );
add_action( 'pre_get_posts', 'wpbandit_pre_get_posts' );

// Add custom wpbandit actions
add_action( 'wpb_portfolio_javascript', 'wpb_portfolio_javascript', 10, 3);


/*---------------------------------------------------------------------------*/
/* Theme :: Functions
/*---------------------------------------------------------------------------*/

/**
	Setup theme
**/
function wpbandit_setup_theme() {
	// Set default options, if necessary
	Air::set_default_options();

	// Create wpbandit_images table
	wpbandit_create_images_table();

	// Load theme shortcodes
	require ( AIR_THEME . '/theme-shortcodes.php' );
}

/**
	Widgets init
	- register additional sidebars and widget areas
**/
function wpbandit_widgets_init() {
	// Footer widgets
	if ( Air::get_option('footer-widgets') ) {
		register_sidebar(array(
			'id'			=> 'widget-footer-1',
			'name'			=> 'Footer Column 1',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-2',
			'name'			=> 'Footer Column 2',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-footer-3',
			'name'			=> 'Footer Column 3',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
	}
	// Header ads
	if ( Air::get_option('header-widget-ads') ) {
		register_sidebar(array(
			'id'			=> 'widget-ads-header',
			'name'			=> 'Ads: Header',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
	}
	// Footer ads
	if ( Air::get_option('footer-widget-ads') ) {
		register_sidebar(array(
			'id'			=> 'widget-ads-footer',
			'name'			=> 'Typegrid shared n MafiaShare.net Ads: Footer',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
	}
	// Home widget columns (above recent posts)
	if ( Air::get_option('home-widgets-top') ) {
		register_sidebar(array(
			'id'			=> 'widget-home-top-1',
			'name'			=> 'Home: Top Column 1',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-home-top-2',
			'name'			=> 'Home: Top Column 2',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
	}
	// Home widget columns (below recent posts)
	if ( Air::get_option('home-widgets-bottom') ) {
		register_sidebar(array(
			'id'			=> 'widget-home-bottom-1',
			'name'			=> 'Home: Bottom Column 1',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
		register_sidebar(array(
			'id'			=> 'widget-home-bottom-2',
			'name'			=> 'Home: Bottom Column 2',
			'before_widget'	=> '<li id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</li>',
			'before_title'	=> '<h3 class="widget-title fix"><span>',
			'after_title'	=> '</span></h3>',
		));
	}
}

/**
	Enqueue stylesheets
**/
function wpbandit_styles() {
	// responsive.css
	if ( !wpb_option('disable-responsive') ) {
		wp_enqueue_style('style-responsive');
	}
	// theme style
	if ( Air::get_option('style') )
		wp_enqueue_style('wpbandit-style',
			get_template_directory_uri().'/styles/'.Air::get_option('style'));
	// style-generated.css
	if ( Air::get_option('generated-css') )
		wp_enqueue_style('wpbandit-style-generated',
			get_template_directory_uri().'/style-generated.css');
	// custom.css
	if ( Air::get_option('custom-css') )
		wp_enqueue_style('wpbandit-custom');
	// font-awesome.min.css
	if ( !wpb_option('disable-font-awesome') ) {
		wp_enqueue_style('font-awesome');
	}
}

/**
	Enqueue scripts
**/
function wpbandit_scripts() {

	// comment-reply.js
	if ( is_singular() )
		wp_enqueue_script('comment-reply');

	// jquery.jplayer.min.js
	if ( !wpb_option('js-disable-jplayer') ) {
		wp_enqueue_script('jplayer');
	}

	// jquery.flexslider.min.js
	wp_enqueue_script('flexslider');
	
	// jquery.sharrre-1.3.4.min
	wp_enqueue_script('sharrre');

	// jquery.theme.js
	wp_enqueue_script('theme');

}

/**
	Action to modify WordPress queries
**/
function wpbandit_pre_get_posts($query) {
	// Are we on main query ?
	if ( !$query->is_main_query() ) return;

	// is_home()
	if ( $query->is_home() && wpb_option('featured-slider-enable') ) {
		// Get post ids
		$post_ids = wpb_get_featured_post_ids();
		// Exclude posts
		if ( $post_ids && !wpb_option('featured-slider-include') )
			$query->set('post__not_in', $post_ids);
	}
}

/**
	Write advanced styles to style-generated.css
**/
function wpbandit_advanced_css($section,$valid) {
	// Are we in styling section ?
	if ( 'styling' != $section ) { return; }
	
	// Advanced stylesheet enabled ?
	if ( '1' != $valid['generated-css'] ) { return; }

	// Set filename
	$file = get_template_directory().'/style-generated.css';

	// Cannot write to style-generated.css
	if ( !is_writable($file) ) {
		// Add error if cannot write to file
		add_settings_error('air-settings-errors','air-updated',
			__('Cannot write to style-generated.css. Please check permissions'.
			' and try saving settings again.','air'),'error');
		// Do not proceed further
		return;
	}

	// Get options
	$color_1 = $valid['styling-color-1'];
	$color_2 = $valid['styling-color-2'];
	
	$body_bg_color = $valid['styling-body-bg-color'];
	$body_bg_image = $valid['styling-body-bg-image'];
	$body_bg_image_repeat = $valid['styling-body-bg-image-repeat'];
	
	// Build style-generated.css
	$styles = '/* Note : Do not place custom styles in this stylesheet */'."\n\n";

	// body
	$styles .= 'body { ';
		if ( $body_bg_color ) {	$styles .= 'background-color: #'.$body_bg_color.'; background-image: none; '; }
		if ( $body_bg_image ) {	$styles .= 'background-image: url('.$body_bg_image.'); '; }
		if ( $body_bg_image_repeat) { $styles .= 'background-repeat: '.$body_bg_image_repeat.'; background-position: top center; '; }		
	$styles .= '}'."\n";
	
	// theme color 2
	if ( $color_2 ) {
		$rgb = wpb_hex2rgb($color_2);
		$styles .= '
.entry-comments,
.jp-play-bar, 
.jp-volume-bar-value { background-color: #'.$color_2.'; }
		'."\n"; }
	
	// theme color 1
	if ( $color_1 ) {
		$rgb = wpb_hex2rgb($color_1);
		$styles .= '
a,
label .required,
.entry-title a:hover,
.entry-share .sharrre .box:hover .count,
.entry-browse li a:hover span,
.entry-related a:hover,
.widget a:hover,
.widget_rss ul li a,
.widget_tag_cloud .tagcloud a:hover,
.widget_calendar a,
.widget_wpb_tabs .wpb-tabs li a:hover,
.comment-awaiting-moderation,
#child-menu .current_page_item > a,
ul.tabs-nav li a.active,
.accordion .title a:hover,
.accordion .title.active a,
.toggle .title:hover,
.toggle .title.active { color: #'.$color_1.'; }

input[type="submit"],
button[type="submit"],
#nav-header.nav-container,
#footer-bottom #to-top,
.entry-tags a:hover,
.entry-browse li a:hover span,
.widget_calendar caption,
.widget_wpb_tabs .wpb-tabs li a.active,
.commentlist .reply a:hover,
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current,
a.button { background-color: #'.$color_1.'; }

@media only screen and (min-width: 720px) {
	#nav-header .nav ul { background-color: #'.$color_1.'; }
	#nav-subheader .nav li.current_page_item > a, 
	#nav-subheader .nav li.current-menu-item > a,
	#nav-subheader .nav li.current-menu-ancestor > a,
	#nav-subheader .nav li.current-post-parent > a { color: #'.$color_1.'; }
}
@media only screen and (max-width: 719px) {
	#nav-header .nav li.current_page_item > a, 
	#nav-header .nav li.current-menu-item > a,
	#nav-header .nav li.current-post-parent > a { color: #'.$color_1.'; }
	#nav-subheader .nav li.current_page_item > a, 
	#nav-subheader .nav li.current-menu-item > a,
	#nav-subheader .nav li.current-post-parent > a { background-color: #'.$color_1.'; }
	#nav-footer .nav li.current_page_item > a, 
	#nav-footer .nav li.current-menu-item > a,
	#nav-footer .nav li.current-post-parent > a { background-color: #'.$color_1.'; }
}

ul.tabs-nav li a.active { border-top-color: #'.$color_1.'; }

::selection { background-color: #'.$color_1.'; }
::-moz-selection { background-color: #'.$color_1.'; }

.wp-pagenavi a { color: #'.$color_1.'!important; border: 1px solid #'.$color_1.'!important; border: 1px solid rgba('.$rgb.', 0.3)!important; }
.wp-pagenavi a:hover,
.wp-pagenavi a:active,
.wp-pagenavi span.current { border: 1px solid #'.$color_1.'!important; }
			'."\n";
		}

	// open file for writing
	$fh = fopen($file, 'w');
	// write styles
	fwrite($fh, $styles);
	// close file
	fclose($fh);

	return TRUE;
}


/*---------------------------------------------------------------------------*/
/* Theme :: Template Functions
/*---------------------------------------------------------------------------*/

/**
	Page Title
**/
function wpb_page_title() {
	global $post;

	$heading = get_post_meta($post->ID,'_heading',TRUE);
	$subheading = get_post_meta($post->ID,'_subheading',TRUE);
	$title = $heading?$heading:the_title();
	if($subheading) {
		$title = $title.' <span>'.$subheading.'</span>';
	}

	return $title;
}

/**
	Blog Heading
**/
function wpb_blog_heading() {
	global $post;

	$heading = Air::get_option('blog-heading');
	$subheading = Air::get_option('blog-subheading');
	$title = $heading;
	if($subheading) {
		$title = $title.' <span>'.$subheading.'</span>';
	}

	return $title;
}

/**
	Page Background Image
**/
function wpb_page_background_image() {
	// Skip meta check on 404, search, and archive pages
	if ( is_404() || is_search() || is_archive() )
		$skip = TRUE;

	// Global $post variable
	global $post;

	// Static front page ?
	$static = (get_option('show_on_front')==='page')?TRUE:FALSE;

	// Check for post/blog image
	if ( !is_home() && !isset($skip) ) {
		$post_image = get_post_meta($post->ID,'_bg-image',TRUE);
		$post_image_settings = get_post_meta($post->ID,'_bg-image-settings',TRUE);
	} elseif( is_home() && $static ) {
		$blog_page_id = get_option('page_for_posts');
		$post_image = get_post_meta($blog_page_id,'_bg-image',TRUE);
		$post_image_settings = get_post_meta($blog_page_id,'_bg-image-settings',TRUE);
	} else {
		$post_image = NULL;
	}

	// Background Image?
	if( !$post_image && Air::get_option('global-bg-image') ) {
		$background = '<img class="page-background '.Air::get_option('global-bg-image-settings').'" src="'.Air::get_option('global-bg-image').'">';
	} elseif ( $post_image ) {
		$background = '<img class="page-background '.$post_image_settings.'" src="'.$post_image.'">';
	} else {
		$background = '';
	}
	return $background;
}

/**
	Page Featured Image Caption
**/
function wpb_post_thumbnail_caption() {
	global $post;
	$output = '';

	$thumbnail_id    = get_post_thumbnail_id($post->ID);
	$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

	if ($thumbnail_image && isset($thumbnail_image[0])) {
		if($thumbnail_image[0]->post_excerpt) {
			$output .= '<span class="caption">'.$thumbnail_image[0]->post_excerpt.'</span>';
		}
		if($thumbnail_image[0]->post_content) {
			$output .= '<span class="description"><i>'.$thumbnail_image[0]->post_content.'</i></span>';
		}
	}

	return isset($output)?$output:'';
}

/**
	Social Media Links
**/
function wpb_social_media_links($attrs = NULL) {
	// Set attributes
	$attrs = isset($attrs)?air_attrs($attrs):'';

	// Get links
	$links = air_social::get_items();

	// Check that we have links
	if (!$links)
		return;

	// Start links
	$output = '<ul'.$attrs.'>';

	// Loop through links
	foreach ($links as $link) {
		// Set target
		$target = ('1'==$link['new-window'])?' target="_blank"':'';
		// Create link
		$output .= sprintf('<li><a class="social-tooltip" href="%1$s" title="%2$s"%4$s><i class="%3$s"></i></a></li>',
					$link['url'],$link['name'],$link['icon'],$target);	
	}

	// End links
	$output .= '</ul>';

	// Return links
	return $output;

	/* Create links
	if ( $links ) {
		// Start output
		$output = '<ul'.$attrs.'>';

		// Loop through links
		foreach($links as $link) {
			$target = ('1'==$link['new-window'])?' target="_blank"':'';
			$output .= '<li><a href="'.$link['url'].'"'.$target.'><span class="icon"><img src="'.
				$link['icon'].'" alt="'.$link['name'].'" /></span><span class="icon-title"><i class="icon-pike"></i>'.$link['name'].'</span></a></li>';
		}
		$output .= '</ul>';

		// Return links
		return $output;
	}*/
}

/**
	Are breadcrumbs enabled?
**/
function wpb_breadcrumbs_enabled() {
	# Static front page
	$static = ('page'===get_option('show_on_front'))?TRUE:FALSE;
	# Disabled
	if(air_breadcrumbs::get_option('breadcrumbs-enable'))
		$status = TRUE;
	# Disabled on front page
	if(is_front_page() && $static && air_breadcrumbs::get_option('breadcrumbs-disable-front'))
		$status = FALSE;
	# Disabled on home page
	if(is_home() && air_breadcrumbs::get_option('breadcrumbs-disable-home'))
		$status = FALSE;
	# Disabled on archive pages
	if(is_archive() && air_breadcrumbs::get_option('breadcrumbs-disable-archive'))
		$status = FALSE;
	# Disabled
	return isset($status)?$status:FALSE;
}

/**
	Breadcrumbs
**/
function wpb_breadcrumbs() {
	return air_breadcrumbs::display();
}

/**
	Get featured post ids
**/
function wpb_get_featured_post_ids() {
	// Set arguments
	$args = array(
		'category'		=> Air::get_option('featured-slider-category'),
		'numberposts'	=> Air::get_option('featured-slider-number')
	);

	// Get posts
	$posts = get_posts($args);

	// Do we have posts?
	if ( !$posts ) return FALSE;

	// Loop through posts
	foreach ( $posts as $post )
		$ids[] = $post->ID;

	// Return post ids
	return $ids;
}


/*---------------------------------------------------------------------------*/
/* Theme :: Filters
/*---------------------------------------------------------------------------*/

/**
	Body Class
**/
function wpbandit_body_class($classes) {
	if ( Air::get_option('sidebar-mobile-disable') )
		$classes[] = 'mobile-sidebar-disable';
	return $classes;
}
add_filter('body_class','wpbandit_body_class');

/**
	Newsflash : Filter popular posts
**/
function wpbandit_filter_popular_posts($where) {
	$range = wpb_option('newsflash-most-popular');

		// Get blog's local current time
		$time = current_time('timestamp');

		// Get posts greater than certain date
		if ( $range ) {
			// Post date > $range
			$where .= " AND post_date > '" . date('Y-m-d', strtotime('-1 ' . $range, $time)) . "'";
		}

		// Comment count > 0
		$where .= " AND comment_count > " . 0;

		// Return $where
		return $where;
}

