(function( $ ) {
    "use strict";

    jQuery(document).ready(function() {

        //CampaignMonitor
        $('#tlcs_design_options-campaign_monitor_authorize').on("click", function(event){
            event.preventDefault();
            $('div.spinner').css('visibility', 'visible');
            $(this).attr('disabled', true);
            let vm = this;
            jQuery.ajax({
                type: "post",
                url : doSubscribe.url,
                data : {
                    action: 'campaign_monitor',
                    api_key: $('#tlcs_design_options-campaign_monitor_api_key').val(),
                    nonce: doSubscribe.nonce
                },
                error: function(e) {
                    $(vm).removeAttr('disabled', true);
                    $('div.spinner').css('visibility', 'hidden');
                   //console.log(e);
                },
                success: function(e){
                    $(vm).removeAttr('disabled', true);
                    //console.log(e);
                    $('div.spinner').css('visibility', 'hidden');

                    if( e.success ) {
                        
                        if ( e.clients ) {

                            var options = '';
                            $.each( e.clients, function( key, val ){
                                options += '<option value="'+ key +'">'+ val +'</option>';
                            });

                            $('#tlcs_design_options-campaign_monitor_client').html(options).find('option[value="'+$('#tlcs_design_options-campaign_monitor_client').data('selected')+'"]').prop('selected', true);

                        }

                        if ( e.lists ) {

                            var options = '';
                            $.each( e.lists, function( key, val ){
                                options += '<option value="'+ key +'">'+ val +'</option>';
                            });

                            $('#tlcs_design_options-campaign_monitor_list').html(options).find('option[value="'+$('#tlcs_design_options-campaign_monitor_list').data('selected')+'"]').prop('selected', true);

                        }


                    }
                    else {
                        console.log( e.error );
                    }

                }
            });  

        });

        // ConvertKit
        $('#tlcs_design_options-convertkit_authorize').on("click", function(event){
            event.preventDefault();
            $('div.spinner').css('visibility', 'visible');
            $(this).attr('disabled', true);
            let vm = this;
            jQuery.ajax({
                type: "post",
                url : doSubscribe.url,
                data : {
                    action: 'convertkit',
                    api_key: $('#tlcs_design_options-convertkit_api_key').val(),
                    nonce: doSubscribe.nonce
                },
                error: function(e) {
                    $(vm).removeAttr('disabled', true);
                    $('div.spinner').css('visibility', 'hidden');
                   //console.log(e);
                },
                success: function(e){
                    $(vm).removeAttr('disabled', true);
                    //console.log(e);
                    $('div.spinner').css('visibility', 'hidden');

                    if( e.success && e.forms ) {
                        
                        var options = '';
                        $.each( e.forms, function( key, val ){
                            options += '<option value="'+ key +'">'+ val +'</option>';
                        });

                        $('#tlcs_design_options-convertkit_form').html(options).find('option[value="'+$('#tlcs_design_options-convertkit_form').data('selected')+'"]').prop('selected', true);
                        
                    }
                    else {
                        console.log( e.error );
                    }

                }
            });  

        });

        //GetResponse
        $('#tlcs_design_options-getresponse_authorize').on("click", function(event){
            event.preventDefault();
            $('div.spinner').css('visibility', 'visible');
            $(this).attr('disabled', true);
            let vm = this;
            jQuery.ajax({
                type: "post",
                url : doSubscribe.url,
                data : {
                    action: 'getresponse',
                    api_key: $('#tlcs_design_options-getresponse_api_key').val(),
                    nonce: doSubscribe.nonce
                },
                error: function(e) {
                    $(vm).removeAttr('disabled', true);
                    $('div.spinner').css('visibility', 'hidden');
                   //console.log(e);
                },
                success: function(e){
                    $(vm).removeAttr('disabled', true);
                    //console.log(e);
                    $('div.spinner').css('visibility', 'hidden');

                    if( e.success && e.campaigns ) {
                        
                        var options = '';
                        $.each( e.campaigns, function( key, val ){
                            options += '<option value="'+ key +'">'+ val +'</option>';
                        });

                        $('#tlcs_design_options-getresponse_campaign').html(options).find('option[value="'+$('#tlcs_design_options-getresponse_campaign').data('selected')+'"]').prop('selected', true);
                        
                    }
                    else {
                        console.log( e.error );
                    }

                }
            });  

        });

        // Get all MailChimp Lists
        $('#tlcs_design_options-mailchimp_authorize').on("click", function(event){
            event.preventDefault();
            $('div.spinner').css('visibility', 'visible');
            $(this).attr('disabled', true);
            let vm = this;
            jQuery.ajax({
                type: "post",
                url : doSubscribe.url,
                data : {
                    action: 'mailchimp',
                    api_key: $('#tlcs_design_options-mailchimp_api_key').val(),
                    nonce: doSubscribe.nonce
                },
                error: function(e) {
                    $(vm).removeAttr('disabled', true);
                    $('div.spinner').css('visibility', 'hidden');
                   //console.log(e);
                },
                success: function(e){
                    $(vm).removeAttr('disabled', true);
                    //console.log(e);
                    $('div.spinner').css('visibility', 'hidden');

                    if( e.success && e.lists ) {
                        
                        var options = '';
                        $.each( e.lists, function( key, val ){
                            options += '<option value="'+ key +'">'+ val +'</option>';
                        });

                        $('#tlcs_design_options-mailchimp_list').html(options).find('option[value="'+$('#tlcs_design_options-mailchimp_list').data('selected')+'"]').prop('selected', true);
                        
                    }
                    else {
                        console.log( e.error );
                    }

                }
            });  

        });

        //SendinBlue
        $('#tlcs_design_options-sendinblue_authorize').on("click", function(event){
            event.preventDefault();
            $('div.spinner').css('visibility', 'visible');
            $(this).attr('disabled', true);
            let vm = this;
            jQuery.ajax({
                type: "post",
                url : doSubscribe.url,
                data : {
                    action: 'sendinblue',
                    api_key: $('#tlcs_design_options-sendinblue_api_key').val(),
                    nonce: doSubscribe.nonce
                },
                error: function(e) {
                    $(vm).removeAttr('disabled', true);
                    $('div.spinner').css('visibility', 'hidden');
                   //console.log(e);
                },
                success: function(e){
                    $(vm).removeAttr('disabled', true);
                    //console.log(e);
                    $('div.spinner').css('visibility', 'hidden');

                    if( e.success && e.lists ) {
                        var options = '';
                        $.each( e.lists, function( key, val ){
                            options += '<option value="'+ key +'">'+ val +'</option>';
                        });

                        $('#tlcs_design_options-sendinblue_list').html(options).find('option[value="'+$('#tlcs_design_options-sendinblue_list').data('selected')+'"]').prop('selected', true);
                        
                    }
                    else {
                        console.log( e.error );
                    }

                }
            });  

        });

        
    // End Scripts.
    });

})( jQuery );