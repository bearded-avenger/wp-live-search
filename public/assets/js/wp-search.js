(function( $, Backbone, _, WP_API_Settings, undefined ) {

	jQuery('document').ready( function( $ ){

		var backboneTemplate = $('#wp-search--tmpl')
		,	itemTemplate     = _.template( backboneTemplate.html() )
		,	posts            = new wp.api.collections.Posts()
		,	postList		 = '#wp-search--post-list'
		,	results          = '#wp-search--results'
		,	loader           = '#wp-search--loader'
		,	ajaxurl			 = wp_search_vars.ajaxurl
		,	api              = WP_API_Settings.root
		,	timer

		$('#wp-search--input').on('keyup', function () {

			// clear the previous timer
			clearTimeout(timer)

			var that        = this
			,	val 		= $(this).val()
			,	url 		= api+'/posts?filter[s]='+val

			// 600ms delay so we dont exectute excessively
			timer = setTimeout(function() {

				// if we have more than 3 characters and if value is teh same
				if ( val.length >= 3 && val == $(that).val() ) {

					// append loading indicator
					//postList.prepend( loader );

					// make the search request
					$.getJSON( url, function( response ) {

						// remove current list of posts
						$(postList).children().remove()

						// show results
						$(results).css('opacity',1)

						// count results and show
						if ( response.length == 0 ) {

							// results are empty int
							$(results).text('0')

							// results are empty placeholder
							if ( !$('#wp-search--no-results').length ) {
								$(postList).prepend( 'nothing found' )
							}

						} else {

							// show how many results we have
							$(results).text( response.length )

							// loop through each object
			                $.each( response, function ( i ) {

			                    $(postList).prepend( itemTemplate( { post: response[i], settings: WP_API_Settings } ) );

			                } );
			            }

					});

				}

			}, 600);

			// if there's no value then destroy the search
			if ( val == '' ) {

				console.log('search destroyed')

			}
		})
	})

})( jQuery, Backbone, _, WP_API_Settings );