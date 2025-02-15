<?php
if (!defined('ABSPATH')) {
    exit;
}

function ccf_handle_form_submission() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        global $wpdb;

        // Verify reCAPTCHA
        $recaptcha_secret = 'YOUR_RECAPTCHA_SECRET_KEY';
        $recaptcha_response = sanitize_text_field($_POST['g-recaptcha-response']);
        $verify_response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=$recaptcha_secret&response=$recaptcha_response");
        $response_body = json_decode(wp_remote_retrieve_body($verify_response));

        if (!$response_body->success) {
            wp_send_json_error(['message' => 'reCAPTCHA verification failed.']);
        }

        // Sanitize data
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);

        // Insert into database
        $wpdb->insert(
            $wpdb->prefix . 'contacts',
            ['name' => $name, 'email' => $email, 'message' => $message],
            ['%s', '%s', '%s']
        );

        wp_send_json_success(['message' => 'Message sent successfully!']);
    }
}
add_action('wp_ajax_ccf_submit_form', 'ccf_handle_form_submission');
add_action('wp_ajax_nopriv_ccf_submit_form', 'ccf_handle_form_submission');
?>
