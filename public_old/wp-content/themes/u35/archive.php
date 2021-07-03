<?php get_header(); ?>

<div class="main group <?php echo wpb_option('general-sidebar','sidebar-right'); ?>">
	
	<div class="content-part">
		<div class="pad group">
		
			<?php get_template_part('partials/page-title'); ?>	
			<?php get_template_part('partials/loop'); ?>
			
		</div><!--/.pad-->
	</div><!--/.content-part-->
	
	<div class="sidebar">	
		<?php get_sidebar(); ?>
	</div><!--/.sidebar-->

</div><!--/.main-->

<?php get_footer(); ?>