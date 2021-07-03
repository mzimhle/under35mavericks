<?php get_header(); ?>

<div class="main group <?php echo wpb_option('general-sidebar','sidebar-right'); ?>">
	
	<div class="content-part">
		<div class="pad group">
		
			<?php get_template_part('partials/page-title'); ?>

			<?php if ( !have_posts() ): ?>
			<div class="empty-note text">
				<h1><?php _e('No search results','typegrid'); ?></h1>
				<p><?php _e('The good news is you can try again.','typegrid'); ?></p>
				<form role="search" method="get" action="<?php echo home_url('/'); ?>">
					<div class="group">
						<input type="text" value="" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="<?php _e('Search','typegrid'); ?>" />
					</div>
				</form>
			</div>
			<?php endif; ?>
			
			<?php get_template_part('partials/loop'); ?>
		
		</div><!--/.pad-->
	</div><!--/.content-part-->
	
	<div class="sidebar">	
		<?php get_sidebar(); ?>
	</div><!--/.sidebar-->

</div><!--/.main-->


<?php get_footer(); ?>