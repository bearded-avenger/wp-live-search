(function( $, Backbone, _, WP_API_Settings, undefined ) {

	jQuery('document').ready( function( $ ){

		var backboneTemplate = $('#wpls--tmpl')
		,	itemTemplate     = _.template( backboneTemplate.html() )
		,	posts            = new wp.api.collections.Posts()
		,	postList		 = '#wpls--post-list'
		,	postList         = $( postList ).data('target') ? $( postList ).data('target') : postList
		,	results          = '#wpls--results'
		,	loader           = '#wpls--loading'
		,	input  			 = '#wpls--input'
		,	helper           = '#wpls--helper'
		,	helperText       = wp_search_vars.helperText
		,	helperSpan       = '<span id="wpls--helper">'+helperText+'</span>'
		,	clear     		 = '<i id="wpls--clear-search" class="dashicons dashicons-dismiss"></i>'
		,	clearItem        = '#wpls--clear-search'
		,	hideClass        = 'wpls--hide'
		,	showClass        = 'wpls--show'
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
			,	url 		= api+'/'+type+'?filter[s]='+val+'&filter[posts_per_page]=20'

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
					$(loader).removeClass('wpls--hide').addClass('wpls--show')

					// remove any helpers
					$( helper ).fadeOut().remove();

					// remove the cose
					destroyClose();

					// make the search request
					$.getJSON( url, function( response ) {

						// remove current list of posts
						$(postList).children().remove()

						// show results
						$(results).parent().removeClass('wpls--hide').addClass('wpls--show')

						// hide loader
						$(loader).removeClass('wpls--show').addClass('wpls--hide')

						// count results and show
						if ( response.length == 0 ) {

							// results are empty int
							$(results).text('0')

							// clear any close buttons
							destroyClose();

						} else {

							// append close button
							if ( !$( clearItem ).length ) {

								$(input).after( clear )
							}

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

				destroySearch();

			}

		});

		/**
		*	Clear search
		*/
		$('#wpls').on('click', clearItem, function(e){

			e.preventDefault();
			destroySearch();
		});

		/**
		* 	Utility function destroy search close
		*/
		function destroyClose(){

			$( clearItem ).remove();

		}

		/**
		*	Utility function to destroy the search
		*/
		function destroySearch(){

			$( postList ).children().remove();
			$( input ).val('');
			$( results ).parent().removeClass('wpls--show').addClass('wpls--hide')
			$( helper ).remove();
			destroyClose()
		}
	});

})( jQuery, Backbone, _, WP_API_Settings );