<?php

/**
*	The view for the item search
*
*	This function is pluggable
*	@since 0.1
*/
if ( !function_exists( 'wp_search_backbone_templates' ) ):

	add_action('wp_footer', 'wp_search_backbone_templates');
	function wp_search_backbone_templates(){

		?>
			<script type="text/html" id="wp-search--tmpl">
				<li id="wp-search--item-<%= post.ID %>" class="wp-search--item">
					<a href="<%= post.link %>" class="wp-search--link">
						<% if ( post.featured_image ) { %>
							<% if ( post.featured_image.attachment_meta ) { %>
								<img class="wp-search--item-image" src="<%= post.featured_image.attachment_meta.sizes.thumbnail.url %>" alt="<% if ( post.featured_image.title ) { %><%=post.featured_image.title%><% } %> ">
							<% } else { %>
								<img class="wp-search--item-image" src="<%= post.featured_image.source %>" alt="<% if ( post.featured_image.title ) { %><%=post.featured_image.title%><% } %> ">
							<% } %>
						<% } %>
						<h4 class="wp-search--item-title"><%= post.title %></h4>
					</a>
				</li>
			</script>
		<?php

	}

endif;