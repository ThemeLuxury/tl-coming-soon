  function media_upload_button(className, text, multiple, type, element) {

  	var image, data;

	jQuery('.' + className).click(function(e) {

		e.preventDefault();
		
	    multiple = multiple || false;

		var image_preview = jQuery(this).parent().find('div.screenshot > img');

		var image_pattern = jQuery(this).parent().find('div.pattern-wrapper');

		var id = jQuery(this).prev('input');

	    var media_uploader = wp.media({
	          title: "Select " + text,
	          button: {
	            text: "Insert " + text
	          },
	          multiple: multiple,
	          library: {
	            type: [type]
	          }
	    }).on('select', function() {

	        var attachment = media_uploader.state().get('selection').first().toJSON();
	        var attachment_gallery = media_uploader.state().get('selection').toJSON();

			switch(element) {

			  case 'gallery':
	
			    jQuery(attachment_gallery).each(function (i) {
			    	image = attachment_gallery[i].url;
			    	jQuery('#image-gallery').append('<div class="grid-square"><div class="screenshot"><div class="overlay-preview"></div><img class="image-preview" src="'+image+'" width="100%"></div><div class="remove-image-button"><span class="dashicons dashicons-no-alt"></span></div><input name="tlcs_design_options[background][image_slider][data][]" type="hidden" value="'+image+'"></div>');
			    });

			    break;

			  case 'pattern':
	

			    jQuery(id).val(attachment.url)

		        jQuery(image_pattern).css("background-image", "url(" + attachment.url + ")");

			    break;

			  case 'image':
			  default:

			    jQuery(id).val(attachment.url)

		        jQuery(image_preview).attr('src', attachment.url);

			    break;
			};

	    }).open();

  });

};