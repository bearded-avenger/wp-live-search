<?php

class wpSearchAssets{

	public function __construct(){

		add_action('wp_enqueue_scripts', 	array($this,'scripts'));
		add_action('wp_enqueue_scripts',	array($this,'styles'), 99);

	}

	/**
	*	Enqueue scripts
	*
	*	@since 0.1
	*/
	public function scripts(){

		// url for json api
		$home_url = function_exists('json_get_url_prefix') ? json_get_url_prefix() : false;
		$settings = array( 'root' => home_url( $home_url ), 'nonce' => wp_create_nonce( 'wp_json' ) );

		// wp api client
		wp_enqueue_script( 'wp-api-js', WP_LIVE_SEARCH_URL.'/public/assets/js/util--wp-api.js', array( 'jquery', 'underscore', 'backbone' ), WP_LIVE_SEARCH_VERSION, true );
		wp_localize_script( 'wp-api-js', 'WP_API_Settings', $settings );

		// wp search script
		wp_enqueue_script('wpls-script', WP_LIVE_SEARCH_URL.'/public/assets/js/wp-live-search.js', array('jquery'), WP_LIVE_SEARCH_VERSION, true);
		wp_localize_script('wpls-script','wp_search_vars', array('helperText' => __('one more character','wp-live-search')));
	}

	/**
	*	Enqueue the style sheet with a later priority to avoid theme conflicts with basic layout styles
	*
	*	@since 0.2
	*/
	public function styles() {

		if ( !defined( 'WPLS_DISABLE_STYLE' ) ) {

			// wp seatch style
			wp_enqueue_style('wpls-style', WP_LIVE_SEARCH_URL.'/public/assets/css/style.css', WP_LIVE_SEARCH_VERSION );

		}
	}
}

new wpSearchAssets();