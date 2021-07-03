<?php

// Set URL
$url = get_template_directory_uri() . '/air/modules/social';

// Get items
$items = air_social::get_items();

?>

<div id="air-main-inner" class="air-text">
	<div id="air-social" class="air-module">
		<div id="air-social-top">
			<div class="air-box first">
				<form class="air-social-form" method="post" action="options.php">
					<?php settings_fields('air-social-settings'); ?>
					
					<div class="air-box-head">
						<h3>Create New Item</h3>		
					</div>
					<div class="air-box-inner">
						<p>
							<label for="social-item-url"><span>URL</span></label>
							<input id="social-item-url" name="air-social[url]" type="text" class="large-text" value="http://">
						</p>
								
						<p>
							<label for="social-item-name"><span>Label</span></label>
							<input id="social-item-name" name="air-social[name]" type="text" class="large-text">
						</p>

						<p>
							<label for="social-item-icon"><span>Icon</span></label>
							<input id="social-item-icon" name="air-social[icon]" type="text" class="large-text">
						</p>

						<p>
							<label for="social-item-new-window">
								<input id="social-item-new-window" name="air-social[new-window]" type="checkbox">
								<span>Open link in new window</span>
							</label>
						</p>

						<input type="hidden" name="air-social[action]" value="new" />
						<input type="submit" id="air-social-submit" class="button-secondary" value="Add Item">
					</div>
				</form>
			</div><!--/air-box-->

			<div class="air-box second">
				<div class="air-box-head">
					<h3>Icons</h3>
				</div>
				<div class="air-box-inner">
					<div id="air-social-icons">
						<?php echo air_social::get_icon_list(); ?>
						<p class="air-credit">Full list of usable icons: <a href="http://fortawesome.github.com/Font-Awesome/" target="_blank">Font Awesome</a></p>
					</div>
				</div>
			</div><!--/air-box-->
			<div class="air-clear"></div>
		</div><!--/air-social-top-->

	<?php if($items): // Have we created any links? ?>

	<form action="options.php" method="post">
	<?php settings_fields('air-social-settings'); ?>
		<div id="air-social-content">
			<div>
				<table class="air-table" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th class="icon">Icon</th>
							<th class="link">Link</th>
							<th class="title">Title</th>
							<th class="actions"></th>
						</tr>
					</thead>
					<tbody class="sortable">
						<?php foreach($items as $key=>$item): ?>
						<tr>
							<td class="icon">
								<div class="icon-box"><i class="<?php echo $item['icon']; ?>"></i></div>
								<input name="<?php echo 'air-social['.$key.']'; ?>[icon]" type="text" class="code" value="<?php echo $item['icon']; ?>">
							</td>
							<td class="link">
								<input name="<?php echo 'air-social['.$key.']'; ?>[url]" type="text" class="code" value="<?php echo $item['url']; ?>"><br>
								<div class="new-window"><input name="<?php echo 'air-social['.$key.']'; ?>[new-window]" type="checkbox" <?php checked($item['new-window'], 1); ?>> Open in new window</div>
							</td>
							<td class="title">
								<input name="<?php echo 'air-social['.$key.']'; ?>[name]" type="text" class="code" value="<?php echo $item['name']; ?>">
							</td>
							<td class="actions">
								<a href="#" class="air-link-move"><img src="<?php echo $url; ?>/img/move.png" alt="Move" title="Drag to Move" /></a>
								<a href="#" class="air-link-delete"><img src="<?php echo $url; ?>/img/delete.png" alt="Delete" /></a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4">
								<p class="air-credit">Module inspired by <a href="http://shakenandstirredweb.com/plugins/social-bartender/" target="_blank">Sawyer Hollenshead</a></p>
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>


	<?php else: // No social links created ?>

		<div id="air-social-content">
			<div class="empty-message">
				<p>You have not created any social links.</p>
			</div>
		</div>

	<?php endif; // End social links checks ?>

	</div><!--/air-module-->
</div><!--/air-main-inner-->


<?php if($items): ?>
<div id="air-footer">
	<p class="submit air-submit">
		<input type="hidden" name="air-social[action]" value="update" />
		<input type="submit" class="button-primary" value="Save Changes" />
	</p>
</div><!--/air-footer-->
</form>
<?php endif; ?>