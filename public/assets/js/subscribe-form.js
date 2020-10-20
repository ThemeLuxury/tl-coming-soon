(function( $ ) {
    "use strict";

    jQuery(document).ready(function() {

          $('.tlcs_close_button_modal').click(function() {
              $('#subscribeModal').modal('hide');
          });

        $('#subscribe_form_feedburner').submit(function(event){
            event.preventDefault();
            window.open('https://feedburner.google.com/fb/a/mailverify?uri=' + $(this).find('#feedburner_username').val(), 'tlcs_window', 'scrollbars=yes,width=550,height=550');
            return true;
        });

        $('#subscribe_form').submit(function(event){
            event.preventDefault();
            $('#alert-success').removeClass('d-block');
            $('#alert-error').removeClass('d-block');
            $(this).find('#faLoading').html('<i class="fas fa-spinner fa-spin"></i>');
            $(this).find('button').attr('disabled', true);
            let vm = this;
            jQuery.ajax({
                type: "post",
                url : onSubscribe.url,
                data : {
                    action: 'subscribe_form',
                    type: $(vm).find('#service').val(),
                    email: $(vm).find('#email').val()
                },
                error: function(e) {
                    console.log(e);
                    $(vm).find('button').removeAttr('disabled', true);
                    $(vm).find('#faLoading').html('<i class="fas fa-paper-plane"></i>');
                },
                success: function(e){
                    console.log(e);
                    var e = $.parseJSON(e);
                    $(vm).find('button').removeAttr('disabled', true);
                    $(vm).find('#faLoading').html('<i class="fas fa-paper-plane"></i>');
                    if ( e.status == 'subscribed' ) {
                        $('#alert-success').html( e.message );
                        $('#alert-success').addClass('d-block');
                    }
                    else
                    {
                        $('#alert-error').html( e.message );
                        $('#alert-error').addClass('d-block');
                    }
                }
            });  

        });
       
    // End Scripts.
    });

})( jQuery );