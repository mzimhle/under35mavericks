<?php
/*
Template Name: Child Menu Right
*/
?>
<?php get_header(); ?>
<?php while ( have_posts() ): the_post(); ?>

<div class="main sidebar-right group">

	<div class="content-part">
		<div class="pad">
			<article id="entry-<?php the_ID(); ?>" <?php post_class('entry group'); ?>>				
				
				<?php get_template_part('partials/page-image'); ?>
				<?php get_template_part('partials/page-title'); ?>
				
				<div class="text">
					<?php the_content(); ?>
					<div class="clear"></div>
				</div>					
			</article>
			
			<?php comments_template(); ?>
			
		</div><!--/.pad-->
	</div><!--/.content-part-->
	
	<div class="sidebar mobile">
		<a class="sidebar-toggle" title="<?php _e('Expand Sidebar','typegrid'); ?>"><i class="icon-reorder"></i></a>
		<div class="sidebar-content">
			<ul id="child-menu" class="group">
				<?php wp_list_pages('title_li=&sort_column=menu_order&depth=3'); ?>
			</ul>
		</div>
	</div><!--/sidebar-->

</div><!--/.main-->

<?php endwhile; ?>
<?php get_footer(); ?>