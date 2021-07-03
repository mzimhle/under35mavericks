<?php $sidebar = wpb_sidebar(); ?>

<a class="sidebar-toggle" title="<?php _e('Expand Sidebar','typegrid'); ?>"><i class="icon-reorder"></i></a>

<?php if ( is_single() && ( wpb_option('single-postnav') == '2' ) ): ?>
<ul class="entry-browse group">
	<li class="previous"><?php previous_post_link('%link', '<i class="icon-chevron-left"></i><strong>'.__('Previous story', 'typegrid').'</strong> <span>%title</span>'); ?></li>
	<li class="next"><?php next_post_link('%link', '<i class="icon-chevron-right"></i><strong>'.__('Next story', 'typegrid').'</strong> <span>%title</span>'); ?></li>
</ul>
<?php endif; ?>

<ul class="sidebar-content">
	<?php dynamic_sidebar($sidebar); ?>
</ul>