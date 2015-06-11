<?php

class wpSearchAssets{

	public function __construct(){

		add_action('wp_enqueue_scripts', array($this,'scripts'));

	}

	public function scripts(){

		// url for json api
		$home_url = function_exists('json_get_url_prefix') ? json_get_url_prefix() : false;
		$settings = array( 'root' => home_url( $home_url ), 'nonce' => wp_create_nonce( 'wp_json' ) );

		// wp api client
		wp_enqueue_script( 'wp-api-js', WP_SEARCH_URL.'/public/assets/js/util--wp-api.js', array( 'jquery', 'underscore', 'backbone' ), WP_SEARCH_VERSION, true );
		wp_localize_script( 'wp-api-js', 'WP_API_Settings', $settings );

		// wp search script
		wp_enqueue_script('wp-search', WP_SEARCH_URL.'/public/assets/js/wp-search.js', array('jquery'), WP_SEARCH_VERSION, true);
		wp_localize_script('wp-search','wp_search_vars', array('helperText' => __('one more character','wp-search')));

		// wp seatch style
		wp_enqueue_style('wp-search-style', WP_SEARCH_URL.'/public/assets/css/style.css', WP_SEARCH_VERSION );
	}

}

new wpSearchAssets();