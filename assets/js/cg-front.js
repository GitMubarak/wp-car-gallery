(function(window, $) {

    // USE STRICT
    "use strict";

    $(document).on('click', '.cg-trigger-link', function(event) {
        event.preventDefault();
        $('#cg-apply-form-modal').iziModal('open');
        $('input#cg_full_name').val('');
        $('input#cg_email').val('');
        $('textarea#cg_cover_letter').val('');
        $('input#cg_upload_resume').val('');
        $('span.error-message').html('');
    });

    var applyFormId = document.getElementById('cg-apply-form-modal');

    if (applyFormId != null) {
        $(applyFormId).iziModal({});
    }



    $('#cg_apply_btn').on('click', function(e) {

        e.preventDefault();

        var frm = document.getElementById('cg_upload_form');
        var msg = '';

        $('span.error-message').hide();

        var fullName = $('input#cg_full_name');
        var email = $('input#cg_email');
        var fileElt = $('input#cg_upload_resume');
        var fileName = fileElt.val();
        var maxSize = 2000000;

        if (fullName.val() == '') {
            fail('This field is required', fullName);
            return false;
        }

        if (email.val() == '') {
            fail('This field is required', email);
            return false;
        }

        if (!cg_validate_email(email.val())) {
            fail('Please Enter Valid Email', email);
            return false;
        }

        if (fileName.length == 0) {
            fail('Please select a file.', fileElt);
            return false;
        } else if (!/\.(docs|pdf)$/.test(fileName)) {
            fail('Only Pdf file is permitted.', fileElt);
            return false;
        } else {
            var file = fileElt.get(0).files[0];
            if (file.size > maxSize) {
                fail('The file is too large. The maximum size is ' + maxSize + ' bytes.', fileElt);
                return false;
            } else {
                frm.submit();
            }
        }

    });

    function fail(msg, field) {
        $('<span class="error-message">' + msg + '</span>').insertAfter(field);
        field.focus();
    };

    function cg_validate_email($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,6})?$/;
        return emailReg.test($email);
    }

})(window, jQuery);