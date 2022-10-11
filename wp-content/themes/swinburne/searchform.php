<?php
$unique_id = esc_attr(uniqid('search-form-'));
?>
<div class="search-result">
	<form role="search" method="get" id="search-form" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
		<div class="input-group search-input">
			<input id="<?php echo $unique_id; ?>" value="<?php echo get_search_query(); ?>" name="s" class="" placeholder="Search...">
	        <span class="input-group-btn input-group-custom">
	            <button type="submit" class="search-submit" id="searchsubmit"><i class="fa fa-search" aria-hidden="true"></i></button>
	        </span>
		</div>

	</form>
</div>