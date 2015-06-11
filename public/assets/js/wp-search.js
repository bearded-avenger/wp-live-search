(function( $, Backbone, _, WP_API_Settings, undefined ) {

	jQuery('document').ready( function( $ ){

		var backboneTemplate = $('#wp-search--tmpl')
		,	itemTemplate     = _.template( backboneTemplate.html() )
		,	posts            = new wp.api.collections.Posts()
		,	postList		 = '#wp-search--post-list'
		,	results          = '#wp-search--results'
		,	loader           = '#wp-search--loading'
		,	input  			 = '#wp-search--input'
		,	api              = WP_API_Settings.root
		,	timer

		$( input ).on('keyup', function () {

			// clear the previous timer
			clearTimeout(timer)

			var that        = this
			,	val 		= $(this).val()
			,	url 		= api+'/posts?filter[s]='+val

			// 600ms delay so we dont exectute excessively
			timer = setTimeout(function() {

				// if we have more than 3 characters and if value is teh same
				if ( val.length >= 3 && val == $(that).val() ) {

					// show loader
					$(loader).css('opacity',1);

					// make the search request
					$.getJSON( url, function( response ) {

						// remove current list of posts
						$(postList).children().remove()

						// show results
						$(results).parent().css('opacity',1)

						// hide loader
						$(loader).css('opacity',0);

						// count results and show
						if ( response.length == 0 ) {

							// results are empty int
							$(results).text('0')

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

				destroySearch()

			}

		}).blur(function(){

			destroySearch();
		})

		/**
		*	Utility function to destroy the search
		*/
		function destroySearch(){

			$( postList ).children().remove();
			$( input ).val('');
			$( results ).parent().css('opacity',0);
		}
	})

})( jQuery, Backbone, _, WP_API_Settings );