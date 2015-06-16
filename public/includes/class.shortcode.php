<?php

class wpSearchShortcode{

	public function __construct(){

		add_shortcode('wp_live_search',		array($this,'shortcode'));
	}

	public function shortcode( $atts, $content = null ) {

		$defaults = array(
			'type'	 		=> 'posts', // 'posts', 'pages', 'books'
			'placeholder'	=> __('Search...','wp-live-search'),
			'results' 		=> __('entries found','wp-live-search'),
			'target'		=> ''
		);
		$atts = shortcode_atts( $defaults, $atts );

		$results_text = $atts['results'] ? $atts['results'] : false;
		$target       = $atts['target'] ? sprintf( 'data-target=%s', trim( $atts['target'] ) ) : false;

		$type = 'posts' == $atts['type'] || 'pages' == $atts['type'] ? $atts['type'] : sprintf('posts?type=%s&', trim( $atts['type'] ) );

		ob_start();

		?>
		<div id="wpls" class="wpls" itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction">

			<div class="wpls--results-wrap">
				<span id="wpls--results"></span>
				<span><?php echo esc_html( $results_text );?></span>
			</div>

			<div id="wpls--input-wrap">
				<input itemprop="query-input" type="text" data-object-type="<?php echo esc_attr( $type );?>" id="wpls--input" placeholder="<?php echo esc_attr( $atts['placeholder'] );?>">
				<div id="wpls--loading" class="wpls--loading"><div class="wpls--loader"></div></div>
			</div>

			<ul itemprop="target" id="wpls--post-list" <?php echo esc_attr( $target );?>></ul>

		</div>

		<?php

		return ob_get_clean();
	}

}

new wpSearchShortcode();