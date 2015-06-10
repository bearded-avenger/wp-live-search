<?php

class wpSearchAssets{

	public function __construct(){

		add_action('wp_enqueue_scripts', array($this,'scripts'));

	}

	public function scripts(){

		// url for json api
		$home_url = function_exists('json_get_url_prefix') ? json_get_url_prefix() : false;

		// wp api client
		wp_enqueue_script( 'wp-api-js', WP_SEARCH_URL.'/public/assets/js/util--wp-api.js', array( 'jquery', 'underscore', 'backbone' ), WP_SEARCH_VERSION, true );

		$settings = array( 'root' => home_url( $home_url ), 'nonce' => wp_create_nonce( 'wp_json' ) );
		wp_localize_script( 'wp-api-js', 'WP_API_Settings', $settings );

		wp_enqueue_script('wp-search', WP_SEARCH_URL. "/public/assets/js/wp-search.js", array('jquery'), WP_SEARCH_VERSION, true);

	}

}

new wpSearchAssets();