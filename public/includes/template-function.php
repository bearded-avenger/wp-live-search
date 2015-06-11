<?php

/**
*	Template function draw the search, essentially a wrapper for do_shortcode('[wp_live_search]')
*
*	@param $type string the type of object to search for - posts, pages
*	@param $placeholder string the text displayed inside the input, defaults to "Search..."
*	@param $results string the text that's displayed after the numerical results return, defaults to "entries found"
*/
function wp_live_search( $type = '', $placeholder = '', $results = '' ){

	if ( empty( $type ) )
		$type = 'posts';

	echo do_shortcode('[wp_live_search type="'.sanitize_text_field( trim( $type ) ).'" placeholder="'.sanitize_text_field( trim( $placeholder ) ).'" results="'.sanitize_text_field( trim( $results ) ).'" ]');

}