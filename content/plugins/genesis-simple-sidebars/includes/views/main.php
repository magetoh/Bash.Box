<?php screen_icon( 'themes' ); ?>
<h2><?php _e( 'Genesis - Simple Sidebars', 'genesis-simple-sidebars' ); ?></h2>

<div id="col-container">

<div id="col-right">
<div class="col-wrap">

<h3><?php _e( 'Current Sidebars', 'genesis-simple-sidebars' ); ?></h3>
<table class="widefat tag fixed" cellspacing="0">
	<thead>
	<tr>
	<th scope="col" id="name" class="manage-column column-name"><?php _e( 'Name', 'genesis-simple-sidebars' ); ?></th>
	<th scope="col" class="manage-column column-slug"><?php _e( 'ID', 'genesis-simple-sidebars' ); ?></th>
	<th scope="col" id="description" class="manage-column column-description"><?php _e( 'Description', 'genesis-simple-sidebars' ); ?></th>
	</tr>
	</thead>

	<tfoot>
	<tr>
	<th scope="col" class="manage-column column-name"><?php _e( 'Name', 'genesis-simple-sidebars' ); ?></th>
	<th scope="col" class="manage-column column-slug"><?php _e( 'ID', 'genesis-simple-sidebars' ); ?></th>
	<th scope="col" class="manage-column column-description"><?php _e( 'Description', 'genesis-simple-sidebars' ); ?></th>
	</tr>
	</tfoot>

	<tbody id="the-list" class="list:tag">

		<?php $this->table_rows(); ?>

	</tbody>
</table>

</div>
</div><!-- /col-right -->

<div id="col-left">
<div class="col-wrap">


<div class="form-wrap">
<h3><?php _e( 'Add New Sidebar', 'genesis-simple-sidebars' ); ?></h3>

<form method="post" action="<?php echo admin_url( 'admin.php?page=simple-sidebars&amp;action=create' ); ?>">
<?php wp_nonce_field( 'simple-sidebars-action_create-sidebar' ); ?>

<div class="form-field form-required">
	<label for="sidebar-name"><?php _e( 'Name', 'genesis-simple-sidebars' ); ?></label>
	<input name="new_sidebar[name]" id="sidebar-name" type="text" value="" size="40" aria-required="true" />
	<p><?php _e( 'A recognizable name for your new sidebar widget area', 'genesis-simple-sidebars' ); ?></p>
</div>

<div class="form-field">
	<label for="sidebar-id"><?php _e( 'ID', 'genesis-simple-sidebars' ); ?></label>
	<input name="new_sidebar[id]" id="sidebar-id" type="text" value="" size="40" />
	<p><?php _e( 'The unique ID is used to register the sidebar widget area', 'genesis-simple-sidebars' ); ?></p>
</div>

<div class="form-field">
	<label for="sidebar-description"><?php _e( 'Description', 'genesis-simple-sidebars' ); ?></label>
	<textarea name="new_sidebar[description]" id="sidebar-description" rows="5" cols="40"></textarea>
</div>

<p class="submit"><input type="submit" class="button" name="submit" id="submit" value="<?php _e( 'Add New Sidebar', 'genesis-simple-sidebars' ); ?>" /></p>
</form></div>

</div>
</div><!-- /col-left -->

</div><!-- /col-container -->