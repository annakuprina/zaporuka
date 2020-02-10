jQuery(document).ready(function($){
	
	/*
	 *
	 * NHP_Options_upload function
	 * Adds media upload functionality to the page
	 *
	 */
	 
//	 var header_clicked = false;
	 
//	jQuery("img[src='']").attr("src", nhp_upload.url);
	
        jQuery('.nhp-opts-upload').click(function (e) {

            e.preventDefault();

            var button = $(this),
                    custom_uploader = wp.media({
                        title: 'Insert image',
                        library: {
                            // uncomment the next line if you want to attach image to the current post
                            // uploadedTo : wp.media.view.settings.post.id, 
                            type: 'image'
                        },
                        button: {
                            text: 'Use this image' // button label text
                        },
                        multiple: false // for multiple image selection set to true
                    }).on('select', function () { // it also has "open" and "close" events 
                        var attachment = custom_uploader.state().get('selection').first().toJSON();

                        $(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.url).next().show();
                    })
                    .open();
        });
	
        $('.nhp-opts-upload-remove').click(function(){
            $(this).hide().prev().val('').prev().addClass('button').html('Upload image');
                return false;
        });
});