<nav class="entry-nav">
	<?php if ( function_exists('wp_pagenavi') ): ?>
		<?php wp_pagenavi(); ?>
	<?php else: ?>
		<ul class="group">
			<li class="prev left"><?php previous_posts_link(); ?></li>
			<li class="next right"><?php next_posts_link(); ?></li>
		</ul>
	<?php endif; ?>
	<div class="clear"></div>
</nav><!--/.entry-nav-->
