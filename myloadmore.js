jQuery(function($){
	$('.loadMorePosts').click(function(){

		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': my_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : my_loadmore_params.current_page
		};

		$.ajax({
			url : my_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) {
					button.text( 'Load more posts' ).before(data); // insert new posts
					misha_loadmore_params.current_page++;

					if ( my_loadmore_params.current_page == my_loadmore_params.max_page )
						button.remove(); // if last page, remove the button

					// you can also fire the "post-load" event here if you use a plugin that requires it
					// $( document.body ).trigger( 'post-load' );
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});
