jQuery(document).ready(function ($) {
    $('#ccf-contact-form').on('submit', function (e) {
        e.preventDefault();

        $.post({
            url: '<?php echo admin_url("admin-ajax.php"); ?>',
            data: $(this).serialize() + '&action=ccf_submit_form',
            success: function (response) {
                $('#ccf-message').text(response.data.message).css('color', 'green');
            },
            error: function () {
                $('#ccf-message').text('Submission failed. Please try again.').css('color', 'red');
            }
        });
    });
});
