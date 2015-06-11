<?php

class wpSearchShortcode{

	public function __construct(){

		add_shortcode('wp_live_search',		array($this,'shortcode'));
	}

	public function shortcode( $atts, $content = null ) {

		$defaults = array(
			'type'	 		=> 'posts',
			'placeholder'	=> __('Search...','wp-live-search'),
			'results' 		=> __('entries found','wp-live-search')
		);
		$atts = shortcode_atts( $defaults, $atts );

		$results_text = $atts['results'] ? $atts['results'] : false;

		ob_start();

		?>
		<div id="wpls" class="wpls">

			<div class="wpls--results-wrap">
				<span id="wpls--results"></span>
				<span><?php echo esc_html( $results_text );?></span>
			</div>

			<div id="wpls--input-wrap">
				<input type="text" id="wpls--input" placeholder="<?php echo esc_attr( $atts['placeholder'] );?>">
				<div id="wpls--loading" class="wpls--loading"><div class="wpls--loader"></div></div>
			</div>

			<ul id="wpls--post-list"></ul>

		</div>

		<?php

		return ob_get_clean();
	}

}

new wpSearchShortcode();