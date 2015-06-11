<?php

/**
*	The view for the item search
*
*	This function is pluggable
*	@since 0.1
*/
if ( !function_exists( 'wpls_backbone_templates' ) ):

	add_action('wp_footer', 'wpls_backbone_templates');
	function wpls_backbone_templates(){

		?>
			<!-- WP Live Search -->
			<script type="text/html" id="wpls--tmpl">
				<li id="wpls--item-<%= post.ID %>" class="wpls--item">
					<a href="<%= post.link %>" class="wpls--link">
						<% if ( post.featured_image ) { %>
							<% if ( post.featured_image.attachment_meta ) { %>
								<img class="wpls--item-image" src="<%= post.featured_image.attachment_meta.sizes.thumbnail.url %>" alt="<% if ( post.featured_image.title ) { %><%=post.featured_image.title%><% } %> ">
							<% } else { %>
								<img class="wpls--item-image" src="<%= post.featured_image.source %>" alt="<% if ( post.featured_image.title ) { %><%=post.featured_image.title%><% } %> ">
							<% } %>
						<% } %>
						<div class="wpls--item-title-wrap">
							<h4 class="wpls--item-title"><%= post.title %></h4>
						</div>
					</a>
				</li>
			</script>
		<?php

	}

endif;