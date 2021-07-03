<?php if( (wpb_option('newsflash-enable-home') && is_home()) || (wpb_option('newsflash-enable-single') && is_single()) || (wpb_option('newsflash-enable-archive') && is_archive()) ) : ?>
		
<script type="text/javascript">
	// Specific flexslider code for custom directionNav markup
	jQuery(window).load(function() {
		var $newsflash = jQuery('.flex-newsflash .flexslider');
		$newsflash
		.flexslider({
			animation: "fade",
			controlsContainer: ".flex-container",
			slideshow: true,
			directionNav: false,
			controlNav: false,
			pauseOnHover: true,
			slideshowSpeed: 25000,
			animationDuration: 600,
			smoothHeight: true,
			touch: false
		});
		jQuery('.newsflash .flex-next').click(function($){
			$.preventDefault();
			$newsflash.flexslider('next');
		});
		jQuery('.newsflash .flex-prev').click(function($){
			$.preventDefault();
			$newsflash.flexslider('prev');
		});
		jQuery('.slides').addClass('loaded');
	}); 
</script>

<div class="newsflash group">
	<div class="flex-container flex-newsflash">
		<div class="flexslider" id="slider-<?php the_ID(); ?>">
			<ul class="slides">		

				<?php if ( wpb_option('newsflash-most-discussed') ): ?>
				
				<?php
					add_filter('posts_where', 'wpbandit_filter_popular_posts');
					$popular = new WP_Query(
						array(
							'no_found_rows'				=> TRUE,
							'update_post_meta_cache'	=> FALSE,
							'update_post_term_cache'	=> FALSE,
							'ignore_sticky_posts'		=> TRUE,
							'posts_per_page'			=> '2',
							'orderby'					=> 'comment_count'
						)
					);
					remove_filter('posts_where', 'wpbandit_filter_popular_posts');
				?>

				<?php if ( $popular->have_posts() ): ?>
				<li class="most-popular">
					<ul>
						<li class="grid first">
							<div class="pad">
								<h3><?php _e('Most Popular','typegrid'); ?></h3>
								<p>
									<?php if ( wpb_option('newsflash-most-popular') == '0' ) _e('All time','typegrid'); ?>
									<?php if ( wpb_option('newsflash-most-popular') == 'month' ) _e('This month','typegrid'); ?>
									<?php if ( wpb_option('newsflash-most-popular') == 'week' ) _e('This week','typegrid'); ?>
									<?php if ( wpb_option('newsflash-most-popular') == 'day' ) _e('Last 24 hours','typegrid'); ?>
								</p>
								<i class="icon-star"></i>
							</div>
						</li>

						<?php while ( $popular->have_posts() ): $popular->the_post(); ?>
						<li class="article grid">
							<div class="pad">
								<div class="overflow">
									<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p class="sub"><?php comments_number(); ?></p>
									<span class="fade"></span>
								</div>
							</div>
						</li>
						<?php endwhile; ?>
					</ul>
				</li><!--/.most-popular-->
				<?php endif; // end have popular posts ?>
				<?php endif; // end most discussed enabled ?>
				

				<?php if ( wpb_option('newsflash-most-recent') ): ?>
				<li class="most-recent">
					<ul>
						<li class="grid first">
							<div class="pad">
								<h3><?php _e('Latest Stories','typegrid'); ?></h3>
								<p><?php _e('What is new?','typegrid'); ?></p>
								<i class="icon-time"></i>
							</div>
						</li>
						
						<?php
							$recent = new WP_Query(
								array(
									'no_found_rows'				=> TRUE,
									'update_post_meta_cache'	=> FALSE,
									'update_post_term_cache'	=> FALSE,
									'ignore_sticky_posts'		=> TRUE,
									'posts_per_page'			=> '2'
								)
							);
						?>

						<?php while ( $recent->have_posts() ): $recent->the_post(); ?>
						<li class="article grid overflow">
							<div class="pad">
								<div class="overflow">
									<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<p class="sub"><?php the_time('F j, Y'); ?></p>
									<span class="fade"></span>
								</div>
							</div>
						</li>
						<?php endwhile; ?>
					</ul>
				</li><!--/.most-recent-->
				<?php endif; ?>
				

				<?php if ( wpb_option('newsflash-recent-comments') ): ?>
				<li class="recent-comments">
					<ul>
						<li class="grid first">
							<div class="pad">
								<h3><?php _e('Comments','typegrid'); ?></h3>
								<p><?php _e('Most Recent','typegrid'); ?></p>
								<i class="icon-comments-alt"></i>
							</div>
						</li>
						
						<?php $comments = get_comments(array('number'=>2,'status'=>'approve','post_status'=>'publish')); ?>
						
						<?php foreach ( $comments as $comment ): ?>
						<li class="article grid overflow">
							<div class="pad">
								<div class="overflow">
									<p class="av"><?php echo get_avatar($comment->comment_author_email,$size='60'); ?></p>
									<p class="sub"><?php echo $comment->comment_author; ?> on: </p>
									<h3 class="title">
										<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
											<?php echo get_the_title($comment->comment_post_ID); ?>
										</a>
									</h3>
									<span class="fade"></span>
								</div>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
				</li><!--/.recent-comments-->
				<?php endif; ?>
				
			</ul>
			<ul class="flex-direction-nav">
				<li><a href="#" class="flex-prev"><i class="icon-chevron-up"></i></a></li>
				<li><a href="#" class="flex-next"><i class="icon-chevron-down"></i></a></li>
			</ul>
		</div><!--/.flexslider-->
	</div><!--/.flex-container-->
</div><!--/.newsflash-->

<?php endif; ?>