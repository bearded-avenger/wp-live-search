<?php

class wpSearchShortcode{

	public function __construct(){

		add_shortcode('wp_search',		array($this,'shortcode'));
	}

	public function shortcode( $atts, $content = null ) {

		$defaults = array(
			'type' => 'posts'
		);
		$atts = shortcode_atts( $defaults, $atts );

		ob_start();

		?>
		<div id="wp-search" class="wp-search">
			<div class="wp-search--results-wrap">
				<span id="wp-search--results"></span>
				<span>entries found</span>
			</div>
			<div id="wp-search--input-wrap">
				<input type="text" id="wp-search--input" placeholder="Search...">
				<div id="wp-search--loading" class="wp-search--loading"><div class="wp-search--loader"></div></div>
			</div>
			<ul id="wp-search--post-list"></ul>
		</div>

		<?php

		return ob_get_clean();
	}

}

new wpSearchShortcode();