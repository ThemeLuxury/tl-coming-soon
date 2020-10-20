(function($){
	jQuery(document).ready(function() {

    	//Upload button
		media_upload_button('upload-button', 'Image', false, 'image', 'image');
		media_upload_button('upload-button-gallery', 'Images', true, 'image', 'gallery');
		media_upload_button('upload-button-pattern', 'Pattern', false, 'image', 'pattern');

		$(document).on('click', 'div.remove-image-button', function(e){
			e.preventDefault();
			$(this).parent().remove();
		});

		$('#image-gallery').sortable();

		// Init Countdown
	    $('#countdown').datetimepicker({ 
	    	format:'Y-m-d H:i:s',
	    	minDate:'-1970/01/02'
	    });

	    // Init Select 2
		$('.tlcs_select2').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Click to select..'
		});

		// Global color picker
	    $('.color_picker_trigger').wpColorPicker();

	    //
	    // BEGIN::COLOR SETTINGS
	    //
	    
	    // Solid color picker
	    $('.solid_color_picker').wpColorPicker({
	        change: function(event, ui){
	            $('.color-preview').css('background', ui.color.toString());
	        }
	    });

	  // Gradient position
	  jQuery("select.gradient-position").on("change", function () {

	      	var gradient_position = jQuery(this).val();
        	var gradient_first_color = jQuery(".gradient_first_color").val();
        	var gradient_second_color = jQuery(".gradient_second_color").val();

	      jQuery(".color-preview").css({
	      	background: gradient_first_color,
	        background: "-moz-linear-gradient(" + gradient_position + ", " + gradient_first_color + ", " + gradient_second_color + " )",
	        background: "-webkit-linear-gradient(" + gradient_position + ", " + gradient_first_color + ", " + gradient_second_color + ")",
	        background: "linear-gradient(" + gradient_position + ", " + gradient_first_color + ", " + gradient_second_color + ")"
	      });

	  });

	  // Overlay gradient colorpicker one
	  jQuery(".gradient_first_color").wpColorPicker({
	    change: function (event, ui) {
	    	var gradient_position = jQuery('select.gradient-position').val();
	      jQuery(".color-preview").css({
	      	background: ui.color.toString(),
	        background: "-moz-linear-gradient(" + gradient_position + ", " + ui.color.toString() + ", " + jQuery(".gradient_second_color").val() + " )",
	        background: "-webkit-linear-gradient(" + gradient_position + ", " + ui.color.toString() + ", " + jQuery(".gradient_second_color").val() + ")",
	        background: "linear-gradient(" + gradient_position + ", " + ui.color.toString() + ", " + jQuery(".gradient_second_color").val() + ")"
	      });
	    }
	  });

	  // Overlay gradient colorpicker two
	  jQuery(".gradient_second_color").wpColorPicker({
	    change: function (event, ui) {
	    	var gradient_position = jQuery('select.gradient-position').val();
	      jQuery(".color-preview").css({
	      	background: ui.color.toString(),
	        background: "-moz-linear-gradient(" + gradient_position + ", " + jQuery(".gradient_first_color").val() + ", " + ui.color.toString() + ")",
	        background: "-webkit-linear-gradient(" + gradient_position + ", " + jQuery(".gradient_first_color").val() + ", " + ui.color.toString() + ")",
	        background: "linear-gradient(" + gradient_position + ", " + jQuery(".gradient_first_color").val() + ", " + ui.color.toString() + ")"
	      });
	    }
	  });
  
  	// Toggle overlay type
	  tlcs_toggle_background_type(jQuery(".background_type").val());

	  jQuery(".background_type").on("change", function () {
	      tlcs_toggle_background_type(jQuery(this).val());
	  });

	  function tlcs_toggle_background_type(type) {
	    switch (type) {
	      
	      case "solid_color":
	        	$('.color-preview').css('background', jQuery(".solid-color").val() );
	        break;

	      case "gradient_color":
		        jQuery(".color-preview").css({
		          background:
		            "-moz-linear-gradient(-45deg, " +
		            jQuery(".gradient_first_color").val() +
		            " 0%, " +
		            jQuery(".gradient_second_color").val() +
		            " 100%)",
		          background:
		            "-webkit-linear-gradient(-45deg, " +
		            jQuery(".gradient_first_color").val() +
		            " 0%, " +
		            jQuery(".gradient_second_color").val() +
		            " 100%)",
		          background:
		            "linear-gradient(135deg, " +
		            jQuery(".gradient_first_color").val() +
		            " 0%, " +
		            jQuery(".gradient_second_color").val() +
		            " 100%)"
		        });
	        break;

	      default:
	        break;
	    }
	  };
		//
		// END::COLOR SETTINGS
		//
	    
		//
	    // BEGIN::OVERLAY COLOR SETTINGS
	    //
	    
	    // Overlay solid color picker
	    $('.overlay_solid_color_picker').wpColorPicker({
	        change: function(event, ui){
	            $('.overlay-preview').css('background', ui.color.toString());
	        }
	    });

	  // Overlay gradient position
	  jQuery("select.overlay-gradient-position").on("change", function () {

	      	var overlay_gradient_position = jQuery(this).val();
        	var overlay_gradient_first_color = jQuery(".overlay_gradient_first_color").val();
        	var overlay_gradient_second_color = jQuery(".overlay_gradient_second_color").val();

	      jQuery(".overlay-preview").css({
	      	background: overlay_gradient_first_color,
	        background: "-moz-linear-gradient(" + overlay_gradient_position + ", " + overlay_gradient_first_color + ", " + overlay_gradient_second_color + " )",
	        background: "-webkit-linear-gradient(" + overlay_gradient_position + ", " + overlay_gradient_first_color + ", " + overlay_gradient_second_color + ")",
	        background: "linear-gradient(" + overlay_gradient_position + ", " + overlay_gradient_first_color + ", " + overlay_gradient_second_color + ")"
	      });

	  });

	  // Overlay gradient colorpicker first
	  jQuery(".overlay_gradient_first_color").wpColorPicker({
	    change: function (event, ui) {
	    	var gradient_position = jQuery('select.overlay-gradient-position').val();
	      jQuery(".overlay-preview").css({
	      	background: ui.color.toString(),
	        background: "-moz-linear-gradient(" + gradient_position + ", " + ui.color.toString() + ", " + jQuery(".overlay_gradient_second_color").val() + " )",
	        background: "-webkit-linear-gradient(" + gradient_position + ", " + ui.color.toString() + ", " + jQuery(".overlay_gradient_second_color").val() + ")",
	        background: "linear-gradient(" + gradient_position + ", " + ui.color.toString() + ", " + jQuery(".overlay_gradient_second_color").val() + ")"
	      });
	    }
	  });

		  // Overlay gradient colorpicker second
		  jQuery(".overlay_gradient_second_color").wpColorPicker({
		    change: function (event, ui) {
		    	var gradient_position = jQuery('select.overlay-gradient-position').val();
		      jQuery(".overlay-preview").css({
		      	background: ui.color.toString(),
		        background: "-moz-linear-gradient(" + gradient_position + ", " + jQuery(".overlay_gradient_first_color").val() + ", " + ui.color.toString() + ")",
		        background: "-webkit-linear-gradient(" + gradient_position + ", " + jQuery(".overlay_gradient_first_color").val() + ", " + ui.color.toString() + ")",
		        background: "linear-gradient(" + gradient_position + ", " + jQuery(".overlay_gradient_first_color").val() + ", " + ui.color.toString() + ")"
		      });
		    }
		  });
	  
	  	// Toggle overlay type
		  tlcs_toggle_overlay_type(jQuery(".overlay_type").val());

		  jQuery(".overlay_type").on("change", function () {
		      tlcs_toggle_overlay_type(jQuery(this).val());
		  });

		  function tlcs_toggle_overlay_type(type) {
		    switch (type) {
		      
		      case "solid_color":
		        $('.overlay-preview').css('background', jQuery(".overlay-solid").val() );
		        break;

		      case "gradient_color":
			        jQuery(".overlay-preview").css({
			          background:
			            "-moz-linear-gradient(-45deg, " +
			            jQuery(".overlay_gradient_first_color").val() +
			            " 0%, " +
			            jQuery(".overlay_gradient_second_color").val() +
			            " 100%)",
			          background:
			            "-webkit-linear-gradient(-45deg, " +
			            jQuery(".overlay_gradient_first_color").val() +
			            " 0%, " +
			            jQuery(".overlay_gradient_second_color").val() +
			            " 100%)",
			          background:
			            "linear-gradient(135deg, " +
			            jQuery(".overlay_gradient_first_color").val() +
			            " 0%, " +
			            jQuery(".overlay_gradient_second_color").val() +
			            " 100%)"
			        });
		        break;

		      default:
		        break;
		    }
		  };

		// END::OVERLAY COLOR SETTINGS

	  	// Overlay opacity
	  	jQuery('.overlay-opacity').on('input', function () {
	      var value = jQuery(this).val();
	      jQuery('.screenshot .overlay-preview').css('opacity', value);
	      jQuery(this).parent().find('p.description > span').html(value);
	    }).trigger('input');

	  	// Background blur
	  	jQuery('.background-blur').on('input', function () {
	      var value = jQuery(this).val();
	      jQuery('.screenshot .image-preview').css('filter', 'blur(' + value + 'px)');
	      jQuery(this).parent().find('p.description > span').html(value);
	    }).trigger('input');

	 	// Toggle Background, Overlay, Service type
	 	tlcs_toggle_select("background_type");
	 	tlcs_toggle_select("overlay_type");
	 	tlcs_toggle_select("service_type");

		function tlcs_toggle_select(className) {
		    jQuery("#tlcs-main-form ." + className).change(function () {
		      var value = jQuery("." + className).val();
		      jQuery("#tlcs-main-form ." + className + "." + value).css("display", "table-row");		      
		      jQuery("#tlcs-main-form ." + className + ":not(." + value + ")").css("display", "none");
		    });

		    jQuery("." + className).first().trigger("change");
		};

		// End scripts
	});

})(jQuery);