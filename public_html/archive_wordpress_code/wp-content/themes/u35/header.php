<!DOCTYPE html> 
<!--[if lt IE 7 ]>				<html class="no-js ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>					<html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>					<html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->	<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php wp_title(''); ?></title>

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic|Fjalla+One' rel='stylesheet' type='text/css'>
	
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/ie/selectivizr.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
<?php echo wpb_page_background_image(); ?>

<div class="body-wrapper">
	
	<header id="header">

		<?php if ( wpb_option('header-widget-ads') ): ?>
			<div class="ads-header group">
				<div class="container">
					<div class="grid one-full">
						<ul><?php dynamic_sidebar('widget-ads-header'); ?></ul>
					</div>
				</div>
			</div><!--/.ads-header-->
		<?php endif; ?>
		
		<?php if ( has_nav_menu( 'header' ) ): ?>
			<nav class="nav-container group" id="nav-header">
				<div class="nav-toggle" id="nav-header-toggle"><i class="icon-reorder"></i></div>
				<div class="nav-wrap">
					<?php wp_nav_menu( array('theme_location'=>'header','menu_class'=>'nav container group','container'=>'','menu_id'=>'','fallback_cb'=>FALSE) ); ?>
				</div>
			</nav><!--/#nav-header-->
		<?php endif; ?>
		
		<div class="container">
			<div class="pad group">		
				<?php echo wpb_site_name(); ?>
				
				<?php if ( !wpb_option('disable-header-search') ): ?>
					<div id="header-search" class="group"><?php get_search_form(); ?></div>
				<?php endif; ?>
				
				<?php if ( !wpb_option('disable-header-social') ): ?>	
					<?php echo wpb_social_media_links(array('id'=>'header-social','class'=>'social-module')); ?>
				<?php endif; ?>	
                <div class="clearfix"></div>
                <?php echo wpb_site_desc(); ?>			
			</div>
			
			<?php if ( is_home() || is_single() || is_archive() ) get_template_part('partials/newsflash'); ?>
			
			<?php if ( has_nav_menu( 'subheader' ) ): ?>
				<nav class="nav-container group" id="nav-subheader">
					<div class="nav-toggle" id="nav-subheader-toggle"><i class="icon-reorder"></i></div>
					<div class="nav-wrap">
						<?php wp_nav_menu( array('theme_location'=>'subheader','menu_class'=>'nav container group','container'=>'','menu_id'=>'','fallback_cb'=>FALSE) ); ?>
					</div>
				</nav><!--/#nav-subheader-->
			<?php endif; ?>
            
            
		</div><!--/.container-->
		
	</header><!--/#header-->

	<div id="page">
		<div class="container">
			<div class="container-inner">