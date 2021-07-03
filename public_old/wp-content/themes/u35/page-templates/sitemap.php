<?php
/*
Template Name: Sitemap
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
				<div class="hr"></div>
				<div class="sitemap group">
					<div class="grid one-third">
						<h4 class="heading"><?php _e('Pages','typegrid'); ?></h4>
						<ul><?php wp_list_pages("title_li=" ); ?></ul>								
					</div>
					<div class="grid one-third">
						<h4 class="heading"><?php _e('All Articles','typegrid'); ?></h4>
						<ul><?php $archive_query = new WP_Query('posts_per_page=1000'); while ( $archive_query->have_posts() ) : $archive_query->the_post(); ?>
							<li>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
								(<?php comments_number('0', '1', '%'); ?>)
							</li>
							<?php endwhile; ?>
						</ul>
					</div>
					<div class="grid one-third last">
						<h4 class="heading"><?php _e('Feeds','typegrid'); ?></h4>
						<ul>
							<li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','typegrid'); ?></a></li>
							<li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','typegrid'); ?></a></li>
						</ul>
						<h4 class="heading"><?php _e('Categories','typegrid'); ?></h4>
						<ul><?php wp_list_categories('sort_column=name&optioncount=1&hierarchical=0&feed=RSS&title_li='); ?></ul>
						<h4 class="heading"><?php _e('Archives','typegrid'); ?></h4>
						<ul><?php wp_get_archives('type=monthly&show_post_count=true'); ?></ul>
					</div>
				</div><!--/sitemap-->
			</article>
			
			<?php comments_template(); ?>
			
		</div><!--/pad-->
	</div><!--/content-->
	
</div><!--/main-->

<?php endwhile;?>
<?php get_footer(); ?>