<?php
/**
 * Plugin Name: Custom Contact Form
 * Description: A simple contact form with Google reCAPTCHA that saves entries in the database and shows them in an admin grid.
 * Version: 1.0
 * Author: Jason Cao
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/form-handler.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-page.php';

// Activation hook - create database table
function ccf_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'ccf_create_table');

// Shortcode to display the form
function ccf_display_form() {
    ob_start();
    ?>
    <form id="ccf-contact-form" method="post">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Message:</label>
        <textarea name="message" required></textarea>
        
        <!-- Google reCAPTCHA -->
        <div class="g-recaptcha" data-sitekey="YOUR_RECAPTCHA_SITE_KEY"></div>

        <button type="submit">Submit</button>
    </form>
    <div id="ccf-message"></div>
    <?php
    return ob_get_clean();
}
add_shortcode('custom_contact_form', 'ccf_display_form');

// Load assets
function ccf_enqueue_assets() {
    wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js', [], null, true);
    wp_enqueue_script('ccf-script', plugin_dir_url(__FILE__) . 'assets/scripts.js', ['jquery'], null, true);
    wp_enqueue_style('ccf-style', plugin_dir_url(__FILE__) . 'assets/styles.css');
}
add_action('wp_enqueue_scripts', 'ccf_enqueue_assets');
?>
