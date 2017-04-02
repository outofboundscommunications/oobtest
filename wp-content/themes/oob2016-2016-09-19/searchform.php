<?php
$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
				<div>
					<label class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</label>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" class="search-input"/>
					<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" class="btn btn-primary"/>
				</div>
			</form>';
echo $form;
?>