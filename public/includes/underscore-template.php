<?php

if ( !function_exists( 'wp_search_backbone_templates' ) ):

	add_action('wp_footer', 'wp_search_backbone_templates');
	function wp_search_backbone_templates(){

		?>
			<script type="text/html" id="wp-search--tmpl">
				<li>
					<a href="<%= post.link %>" class="wp-search--item" data-postid="<%= post.ID %>" >
						<% if ( post.featured_image ) { %>
							<img class="wp-search--item-image" src="<%= post.featured_image.attachment_meta.sizes.thumbnail.url %>">
						<% } %>
						<h4 class="wp-search--item-title"><%= post.title %></h4>
					</a>
				</li>
			</script>
		<?php

	}

endif;