(function($) {
    'use strict';

    function masteqrPost() {
        jQuery(".masteqr-post").each(function() {

            var $sliderDynamicId = '#' + $(this).attr('id');

            new QRCode($($sliderDynamicId).get(0), {
                text: $(this).data('content'),
                width: $(this).data('size'),
                height: $(this).data('size'),
                dotScale: datas.scale,
                colorDark: datas.qrcolor,
                colorLight: datas.bgcolor
            });
        });

    }
    masteqrPost();

    $(".mqrdownload").each(function(index) {
        $(this).on("click", function() {
            var ereer = $(this).closest('.masteqr-postwarpper').children('.masteqr-post').attr('id');
            var $Mqrds = '#' + ereer + ' canvas';
            var image = document.querySelector($Mqrds).toDataURL("image/png").replace("image/png", "image/octet-stream");
            this.setAttribute("href", image)
        });
    });
    $(".mqrdownloads").each(function(index) {
        $(this).on("click", function() {
            var ereer = $(this).parent('.masteqr-postwarpper').children('.masteqr-post').attr('id');
            var $Mqrds = '#' + ereer + ' canvas';
            var image = document.querySelector($Mqrds).toDataURL("image/png").replace("image/png", "image/octet-stream");
            this.setAttribute("href", image)
        });
    });





})(jQuery);