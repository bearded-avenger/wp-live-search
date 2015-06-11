(function( $, Backbone, _, WP_API_Settings, undefined ) {

	jQuery('document').ready( function( $ ){

		var backboneTemplate = $('#wpls--tmpl')
		,	itemTemplate     = _.template( backboneTemplate.html() )
		,	posts            = new wp.api.collections.Posts()
		,	postList		 = '#wpls--post-list'
		,	results          = '#wpls--results'
		,	loader           = '#wpls--loading'
		,	input  			 = '#wpls--input'
		,	helper           = '#wpls--helper'
		,	helperText       = wp_search_vars.helperText
		,	helperSpan       = '<span id="wpls--helper">'+helperText+'</span>'
		,	api              = WP_API_Settings.root
		,	timer

		$( input ).on('keyup keypress', function ( e ) {

			// clear the previous timer
			clearTimeout(timer)

			var key         = e.which
			,	that        = this
			,	val 		= $.trim( $(this).val() )
			,	valEqual    = val == $(that).val()
			,	notEmpty    = '' !== val
			,	type        = $(this).data('object-type')
			,	url 		= api+'/'+type+'?filter[s]='+val

			// 600ms delay so we dont exectute excessively
			timer = setTimeout(function() {

				// don't proceed if the value is empty or not equal to itself
				if ( !valEqual && !notEmpty )
					return false;

				// what if the user only types two characters?
				if ( val.length == 2 && !$(helper).length ) {

					$(input).after( helperSpan )

				}

				// if we have more than 3 characters
				if ( val.length >= 3 || val.length >= 3 && 13 == key ) {

					// show loader
					$(loader).css('opacity',1);

					// remove any helpers
					$( helper ).fadeOut().remove()

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

		})/*.blur(function(){

			destroySearch();
		})

		/**
		*	Utility function to destroy the search
		*/
		function destroySearch(){

			$( postList ).children().remove();
			$( input ).val('');
			$( results ).parent().css('opacity',0);
			$( helper ).remove()
		}
	})

})( jQuery, Backbone, _, WP_API_Settings );