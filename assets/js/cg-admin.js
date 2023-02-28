(function($) {

    // USE STRICT
    "use strict";

    var cgColorPicker = [
        '#cg_single_container_bg_color',
        '#cg_single_info_font_color',
        '#cg_listing_title_font_color',
        '#cg_listing_overview_font_color',
        '#cg_single_title_font_color',
        '#cg_single_apply_btn_bg_color'
    ];

    $.each(cgColorPicker, function(index, value) {
        $(value).wpColorPicker();
    });

    $("#cg_deadline").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
    });

    $('.cg-closebtn').on('click', function() {
        this.parentElement.style.display = 'none';
    });

})(jQuery);