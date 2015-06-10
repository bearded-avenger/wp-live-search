<?php

if ( !function_exists( 'wp_search_backbone_templates' ) ):

	add_action('wp_footer', 'wp_search_backbone_templates');
	function wp_search_backbone_templates(){

		?>
			<script type="text/html" id="wp-search--tmpl">
				<li>
					<a href="<%= post.link %>" class="wp-search--item" data-postid="<%= post.ID %>" >
						<%= post.title %>
					</a>
				</li>
			</script>
		<?php

	}

endif;