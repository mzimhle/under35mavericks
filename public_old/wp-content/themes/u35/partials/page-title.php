<?php if ( is_home() && wpb_option('blog-heading') ): ?>			
	<div class="page-title">
		<h4><i class="icon-pencil"></i><?php echo wpb_blog_heading(); ?></h4>
	</div>

<?php elseif ( is_search() ): ?>
	<div class="page-title">
		<h2><i class="icon-search"></i><?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php _e('Search results for:','typegrid'); ?> <span>"<?php echo get_search_query(); ?>"</span></h2>
	</div>
	
<?php elseif ( is_404() ): ?>
	<div class="page-title">
		<h2><i class="icon-exclamation-sign"></i><i class="icon-error"></i><?php _e('Error 404.','typegrid'); ?> <span><?php _e('Oops!','typegrid'); ?></span></h2>
	</div>
	
<?php elseif ( is_page() ): ?>
	<div class="page-title">
		<h1><?php echo wpb_page_title(); ?></h1>
	</div>
	
<?php elseif ( is_author() ): ?>
	<div class="page-title">
		<?php $author = get_userdata( get_query_var('author') );?>
		<h2><i class="icon-user"></i><?php _e('Author:','typegrid'); ?> <span><?php echo $author->display_name;?></span></h2>
	</div>
	
<?php elseif ( is_category() ): ?>
	<div class="page-title">
		<h2><i class="icon-folder-open"></i><?php _e('Category:','typegrid'); ?> <span><?php echo single_cat_title('', false); ?></span></h2>	
		<?php if (category_description() == '') : ?>
		<?php else : ?>
			<div class="category-description">
			<?php echo category_description(); ?>
			</div>
		<?php endif; ?>
	</div>	
	
<?php elseif ( is_tag() ): ?>
	<div class="page-title">
		<h2><i class="icon-tags"></i><?php _e('Tagged:','typegrid'); ?> <span><?php echo single_tag_title('', false); ?></span></h2>
	</div>	

<?php elseif ( is_day() ): ?>
	<div class="page-title">
		<h2><i class="icon-calendar"></i><?php _e('Daily Archive:','typegrid'); ?> <span><?php echo get_the_time('F j, Y'); ?></span></h2>
	</div>	
	
<?php elseif ( is_month() ): ?>
	<div class="page-title">
		<h2><i class="icon-calendar"></i><?php _e('Monthly Archive:','typegrid'); ?> <span><?php echo get_the_time('F Y'); ?></span></h2>
	</div>	
	
<?php elseif ( is_year() ): ?>
	<div class="page-title">
		<h2><i class="icon-calendar"></i><?php _e('Yearly Archive:','typegrid'); ?> <span><?php echo get_the_time('Y'); ?></span></h2>
	</div>	
	
<?php endif; ?>