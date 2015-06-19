<?php

class wpSearchShortcode{

	public function __construct(){

		add_shortcode('wp_live_search',		array($this,'shortcode'));
	}

	public function shortcode( $atts, $content = null ) {

		$defaults = array(
			'type'	 		=> 'posts', // 'posts', 'pages', 'books', or 'posts,pages,books'
			'multi'			=> false, // set to true if passing multiple types above
			'number'		=> 20, // return a certain number of search results
			'compact'		=> false, // display search in a scaled down version with less padding and smaller fonts
			'dropdown'		=> false, // display results as a drop down instead of pushing down content around the search
			'excerpt'		=> false, // optionally display the excerpt along with the title and featured image
			'placeholder'	=> __('Search...','wp-live-search'),
			'results' 		=> __('entries found','wp-live-search'),
			'results_style' => 'default', // 'default', 'inside' : repositions the search label
			'target'		=> '' // an optional UL item to send the search result items too
		);
		$atts = shortcode_atts( $defaults, $atts );

		$mode        	= true == $atts['compact'] ? 'wpls--style-compact' : false;
		$collapse     	= true == $atts['dropdown'] ? 'wpls--collapse' : false;
		$results_text 	= $atts['results'] ? $atts['results'] : false;
		$results_style  = sprintf('wpls--results-style-%s', trim( $atts['results_style'] ) );

		// if multiple post objects being passed
		if ( true == $atts['multi'] ) {

			// explode into chunks and return a type endponig
			$chunks = self::return_chunks( $atts['type'] );

			// return the type to search
			$type = $atts['type'] ? sprintf('posts?%s', $chunks ) : false;

		} else {

			$type = 'posts' == $atts['type'] || 'pages' == $atts['type'] ? sprintf('%s?', trim( $atts['type'] ) ) : sprintf('posts?type=%s&', trim( $atts['type'] ) );
		}

		ob_start();

		do_action('wpls_before'); // action ?>

		<div id="wpls" class="wpls <?php echo esc_attr( $mode );?> <?php echo esc_attr( $collapse );?> <?php echo esc_attr( $results_style );?> " itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" <?php echo self::build_local_atts( $atts );?> >

			<?php do_action('wpls_inside_top'); // action ?>

			<?php if( $results_style !== false ) { ?>
			<div class="wpls--results-wrap">

				<?php do_action('wpls_inside_results'); // action ?>

				<span id="wpls--results"></span>
				<span><?php echo esc_html( $results_text );?></span>

			</div>
			<?php } ?>

			<div id="wpls--input-wrap">

				<?php do_action('wpls_inside_input'); // action ?>

				<input itemprop="query-input" type="text" data-object-type="<?php echo esc_attr( $type );?>" id="wpls--input" placeholder="<?php echo esc_attr( $atts['placeholder'] );?>">
				<div id="wpls--loading" class="wpls--loading"><div class="wpls--loader"></div></div>

			</div>

			<?php if ( !$atts['target'] ) { ?>
			<ul itemprop="target" id="wpls--post-list"></ul>
			<?php } ?>

			<?php do_action('wpls_inside_bottom'); // action ?>

		</div>

		<?php do_action('wpls_after'); // action

		return ob_get_clean();
	}

	/**
	*	Return data atts according to option
	*
	*	@since 0.8
	*	@access private
	*/
	private static function build_local_atts( $atts ) {

		$out = '';

		if ( $atts['number'] ) { $out .= sprintf(' data-number=%s ', $atts['number'] ); }
		if ( $atts['target'] ) { $out .= sprintf(' data-target=%s ', $atts['target'] ); }
		if ( true == $atts['excerpt'] ) { $out .= ' data-excerpt=enabled '; }

		return $out;
	}

	/**
	*	Return a search filter paramater based on the number of types a user passes
	*
	*	@since 0.7
	*	@access private
	*/
	private static function return_chunks( $types ){

		if ( empty( $types ) ) {
			return;
		}

		$out = '';

		$types = explode(',', $types );

		if ( $types ):

			foreach ( (array) $types as $type ) {
				$out .= sprintf('type[]=%s&', $type);
			}

		endif;

		return $out;

	}

}

new wpSearchShortcode();