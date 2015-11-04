
<div class="search-wrap">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get" class="form-inline">
		<div class="form-group">
			<fieldset>
				<div class="input-group">
					<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" class="input-medium form-control" name="s">
				</div>
				<button type="submit" class="btn btn-primary"><i class="dashicons dashicons-search"></i> <?php echo esc_attr( __( 'Search', 'activetab' ) ); ?></button>
			</fieldset>
		</div>
	</form>
</div>
