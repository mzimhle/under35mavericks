<?php get_header(); ?>

<div class="main group <?php echo wpb_option('general-sidebar','sidebar-right'); ?>">
	
	<div class="content-part">
		<div class="pad group">
		
			<?php get_template_part('partials/page-title'); ?>	
			
			<div class="empty-note text">
				<h1><?php _e('Typegrid shared on <a href="http://www.mafiashare.net">MafiaShare.net</a>  - Something went wrong.','typegrid'); ?></h1>
				<p><?php _e('The page you are looking for could not be found.','typegrid'); ?></p>
				<form role="search" method="get" action="<?php echo home_url('/'); ?>">
					<div class="group">
						<input type="text" value="" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="<?php _e('Search','typegrid'); ?>" />
					</div>
				</form>
			</div>
		
		</div><!--/.pad-->
	</div><!--/.content-part-->
	
	<div class="sidebar">	
		<?php get_sidebar(); ?>
	</div><!--/.sidebar-->

</div><!--/.main-->

<?php get_footer(); ?>
