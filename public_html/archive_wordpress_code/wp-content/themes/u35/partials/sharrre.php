<?php if ( !wpb_option('single-share-disable') ): ?>

<div class="entry-share">
	<span>Share</span>
	<div id="twitter" data-url="<?php echo the_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="Tweet"></div>
	<div id="facebook" data-url="<?php echo the_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="Like"></div>
	<div id="googleplus" data-url="<?php echo the_permalink(); ?>" data-text="<?php echo the_title(); ?>" data-title="+1"></div>
</div><!--/.entry-share-->

<script type="text/javascript">
	// Sharrre
	jQuery(document).ready(function(){
		jQuery('#twitter').sharrre({
			share: {
				twitter: true
			},
			template: '<a class="box" href="#"><div class="count" href="#">{total}</div><div class="share"><i class="icon-twitter"></i></div></a>',
			enableHover: false,
			enableTracking: true,
			buttons: { twitter: {via: '<?php echo wpb_option('twitter-username'); ?>'}},
			click: function(api, options){
				api.simulateClick();
				api.openPopup('twitter');
			}
		});
		jQuery('#facebook').sharrre({
			share: {
				facebook: true
			},
			template: '<a class="box" href="#"><div class="count" href="#">{total}</div><div class="share"><i class="icon-facebook-sign"></i></div></a>',
			enableHover: false,
			enableTracking: true,
			click: function(api, options){
				api.simulateClick();
				api.openPopup('facebook');
			}
		});
		jQuery('#googleplus').sharrre({
			share: {
				googlePlus: true
			},
			template: '<a class="box" href="#"><div class="count" href="#">{total}</div><div class="share"><i class="icon-google-plus-sign"></i></div></a>',
			enableHover: false,
			enableTracking: true,
			urlCurl: '',
			click: function(api, options){
				api.simulateClick();
				api.openPopup('googlePlus');
			}
		});
	});
</script>

<?php endif; ?>