<?php
/*
Template Name: Full-width
*/
?>
<?php get_header(); ?>
<?php while ( have_posts() ): the_post(); ?>

<div class="main group">

	<div class="content">
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
			
		</div><!--/pad-->
	</div><!--/content-->
	
</div><!--/main-->

<?php endwhile;?>
<?php get_footer(); ?>