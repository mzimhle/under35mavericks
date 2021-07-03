<?php $related = air_related_posts::get_posts(); ?>

<h4 class="heading related">
	<i class="icon-hand-right"></i><?php echo air_related_posts::get_option('title',__('You may also like...','typegrid')); ?>
</h4>

<?php if ( $related->have_posts() ): ?>
<ul class="entry-related group">
	
	<?php while ( $related->have_posts() ) : $related->the_post(); ?>
	<li class="related">
		<article <?php post_class(); ?>>
			<a href="<?php the_permalink(); ?>">
				
				<?php if ( !air_related_posts::get_option('hide-thumbnail') ): ?>
					<span class="entry-thumbnail">
						<?php if ( has_post_thumbnail() ): ?>
							<?php the_post_thumbnail('size-thumbnail-medium'); ?>
						<?php else: ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/placeholder.png" alt="<?php the_title() ;?>" />
						<?php endif; ?>
						<?php if ( has_post_format('video') ) echo'<span class="thumb-icon"><i class="icon-play"></i></span>'; ?>
						<?php if ( has_post_format('audio') ) echo'<span class="thumb-icon"><i class="icon-volume-up"></i></span>'; ?>
					</span>
				<?php endif; ?>

				<span class="rel-entry-title"><?php the_title(); ?></span>

				<?php if ( !air_related_posts::get_option('hide-date') ): ?>
					<span class="rel-entry-date"><?php the_time('j M, Y'); ?></span>
				<?php endif; ?>
			</a>
		</article>
	</li><!--/.related-->
	<?php endwhile; ?>

</ul><!--/.entry-related-->
<?php endif; ?>

<?php wp_reset_query(); ?>
