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
			'placeholder'	=> __('Search...','wp-live-search'),
			'results' 		=> __('entries found','wp-live-search'),
			'results_style' => 'default', // 'default', 'inside' : repositions the search label
			'target'		=> '' // an optional UL item to send the search result items too
		);
		$atts = shortcode_atts( $defaults, $atts );

		$results_text 	= $atts['results'] ? $atts['results'] : false;
		$target       	= $atts['target'] ? sprintf( 'data-target=%s', trim( $atts['target'] ) ) : false;
		$number       	= $atts['number'] ? sprintf( 'data-number=%s', trim( absint( $atts['number'] ) ) ) : false;
		$mode        	= true == $atts['compact'] ? 'wpls--style-compact' : false;
		$collapse     	= true == $atts['dropdown'] ? 'wpls--collapse' : false;
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

		?>
		<div id="wpls" class="wpls <?php echo esc_attr( $mode );?> <?php echo esc_attr( $collapse );?> <?php echo esc_attr( $results_style );?> " itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction" <?php echo esc_attr( $number );?> <?php echo esc_attr( $target );?>>

			<?php if( $results_style !== false ) { ?>
			<div class="wpls--results-wrap">
				<span id="wpls--results"></span>
				<span><?php echo esc_html( $results_text );?></span>
			</div>
			<?php } ?>

			<div id="wpls--input-wrap">
				<input itemprop="query-input" type="text" data-object-type="<?php echo esc_attr( $type );?>" id="wpls--input" placeholder="<?php echo esc_attr( $atts['placeholder'] );?>">
				<div id="wpls--loading" class="wpls--loading"><div class="wpls--loader"></div></div>
			</div>

			<?php if ( !$atts['target'] ) { ?>
			<ul itemprop="target" id="wpls--post-list"></ul>
			<?php } ?>

		</div>

		<?php

		return ob_get_clean();
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