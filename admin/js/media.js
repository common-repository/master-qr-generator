jQuery(document).ready(function($) {

    var wooqr_uploader;
    $('#upload_image_button').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (wooqr_uploader) {
            wooqr_uploader.open();
            return;
        }
        //Extend the wp.media object
        wooqr_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        wooqr_uploader.on('select', function() {
            attachment = wooqr_uploader.state().get('selection').first().toJSON();
            $('#background_image').val(attachment.url);
            $('#background_image').attr("value", attachment.url);
            $('#background_image').trigger('change');

            //$("#wooqrimg-buffer").attr("src", attachment.url);

        });
        //Open the uploader dialog
        wooqr_uploader.open();
    });


});jQuery(document).ready(function($) {

    var wooqr_uploader;
    $('#upload_image_button_id').click(function(e) {
        e.preventDefault();
        //If the uploader object has already been created, reopen the dialog
        if (wooqr_uploader) {
            wooqr_uploader.open();
            return;
        }
        //Extend the wp.media object
        wooqr_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        wooqr_uploader.on('select', function() {
            attachment = wooqr_uploader.state().get('selection').first().toJSON();
            $('#background_image_id').val(attachment.url);
            $('#background_image_id').attr("value", attachment.url);
            $('#background_image_id').trigger('change');

            //$("#wooqrimg-buffer").attr("src", attachment.url);

        });
        //Open the uploader dialog
        wooqr_uploader.open();
    });


});


;
(function($) {

    "use strict";

    jQuery(document).ready(function($) {

        $(document).on("click", ".qrc_image_button", function(e) {
            e.preventDefault();
            var $button = $(this);
            var file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select or upload image',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Select'
                },
                multiple: false
            });
            file_frame.on('select', function() {

                var attachment = file_frame.state().get('selection').first().toJSON();

                $button.siblings('input').val(attachment.url);
            });

            file_frame.open();
        });
    });

})(jQuery);


