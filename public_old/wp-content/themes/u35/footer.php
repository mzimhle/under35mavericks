			</div><!--/.container-inner-->
		</div><!--/.container-->
	</div><!--/#page-->
	
	<div class="clear"></div>
	
	<footer id="footer">
			
		<?php if ( wpb_option('footer-widget-ads') ): ?>
		<div class="ads-footer group">
			<div class="container">
				<div class="grid one-full">
					<ul><?php dynamic_sidebar('widget-ads-footer'); ?></ul>
				</div>
			</div>
		</div><!--/.ads-footer-->
		<?php endif; ?>
			
		<?php if ( wpb_breadcrumbs_enabled() ): ?>
		<div id="breadcrumb">
			<div class="container">
				<div class="pad group">
					<?php echo wpb_breadcrumbs(); ?>
				</div>
			</div><!--/.container-->
		</div><!--/#breadcrumb-->
		<?php endif; ?>
			
		<div class="container">
			
			<div id="footer-content" class="pad group">
				<div class="grid">
					<?php if ( wpb_option('footer-logo') ): ?>
						<img id="footer-logo" src="<?php echo wpb_option('footer-logo'); ?>" alt="<?php get_bloginfo('name'); ?>">
					<?php endif; ?>
					
					<?php echo wpb_social_media_links(array('id'=>'footer-social','class'=>'social-module')); ?>
				</div>
			</div>
			
			<?php if ( wpb_option('footer-widgets') ): ?>
			<div id="footer-widgets" class="pad group">
				<div class="grid one-third">
					<ul><?php dynamic_sidebar('widget-footer-1'); ?></ul>
				</div>
				<div class="grid one-third">
					<ul><?php dynamic_sidebar('widget-footer-2'); ?></ul>
				</div>
				<div class="grid one-third last">
					<ul><?php dynamic_sidebar('widget-footer-3'); ?></ul>
				</div>
			</div>
			<?php endif; ?>	

		</div><!--/.container-->
		
		<?php if ( has_nav_menu( 'footer' ) ): ?>
			<nav class="nav-container group" id="nav-footer">
				<div class="nav-toggle" id="nav-footer-toggle"><i class="icon-reorder"></i></div>
				<div class="nav-wrap">
					<?php wp_nav_menu( array('theme_location'=>'footer','menu_class'=>'nav container group','container'=>'','menu_id'=>'','fallback_cb'=>FALSE) ); ?>
				</div>
			</nav><!--/#nav-footer-->
		<?php endif; ?>
		
		<div id="footer-bottom">
			<div class="container">
				<div class="pad group">
					
					<a id="to-top" href="http://www.vectors4all.net"><i class="icon-angle-up"></i></a>
				</div>
			</div>
		</div><!--/#footer-bottom-->
		
	</footer><!--/#footer-->
	
</div><!--/.body-wrapper-->
<?php wp_footer(); ?>
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/ie/respond.min.js"></script> <![endif]-->
</body>
</html>