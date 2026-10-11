(function($) {

    // USE STRICT
    "use strict";

    var cgColorPicker = [
        '#cg_listing_title_font_color',
        '#cg_single_car_title_font_color'
    ];

    $.each(cgColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $('.cg-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);