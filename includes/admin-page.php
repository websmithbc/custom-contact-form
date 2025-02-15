<?php
if (!defined('ABSPATH')) {
    exit;
}

// Add menu item
function ccf_add_admin_menu() {
    add_menu_page('Contacts', 'Contacts', 'manage_options', 'ccf-contacts', 'ccf_contacts_page');
}
add_action('admin_menu', 'ccf_add_admin_menu');

function ccf_contacts_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . "contacts";
    $contacts = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

    echo '<div class="wrap"><h2>Contact Submissions</h2>';
    echo '<table class="widefat fixed" cellspacing="0"><thead><tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr></thead><tbody>';

    foreach ($contacts as $contact) {
        echo "<tr>
                <td>{$contact->name}</td>
                <td>{$contact->email}</td>
                <td>{$contact->message}</td>
                <td>{$contact->created_at}</td>
              </tr>";
    }

    echo '</tbody></table></div>';
}
?>
