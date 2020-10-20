(function( $ ) {
    "use strict";

	jQuery(document).ready(function($) {

		// Toggle Status
		jQuery('#tlcs_toggle').click(function(e) {
			e.preventDefault();
			var nonce = jQuery(this).data('nonce');
			let vm = this;
            jQuery.ajax({
                type: "post",
                url : doToggle.url,
                data : {
                    action: 'tlcs_toggle',
                    nonce: nonce,
                    status: $(vm).find('#tlcs_toggle_status').val()
                },
                error: function(e) {
                    console.log(e);
                },
                success: function(e){
                    if (e == 'success') { location.reload(); }
                    else console.log(e);
                }
            });

		});
        //
    });

})( jQuery );
