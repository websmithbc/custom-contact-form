# Custom Contact Form Plugin

A simple WordPress plugin that adds a contact form with Google reCAPTCHA. The form submissions are saved in the database (`wp_contacts`) and displayed in an admin panel grid.

## Features
- Google reCAPTCHA integration to prevent spam.
- Saves form submissions to the WordPress database.
- AJAX-powered form submission.
- Displays submitted contacts in the WordPress admin panel.

## Installation

### 1. Download & Upload
1. Download the plugin ZIP file or clone the repository.
2. Upload the folder `custom-contact-form` to the `wp-content/plugins/` directory.

### 2. Activate the Plugin
1. Go to **WordPress Admin > Plugins**.
2. Find **Custom Contact Form** and click **Activate**.

### 3. Configure Google reCAPTCHA
1. Get your reCAPTCHA v2 site key and secret key from [Google reCAPTCHA](https://www.google.com/recaptcha/).
2. Edit `custom-contact-form.php` and replace:
   ```php
   define('RECAPTCHA_SITE_KEY', 'YOUR_RECAPTCHA_SITE_KEY');
   define('RECAPTCHA_SECRET_KEY', 'YOUR_RECAPTCHA_SECRET_KEY');
   ```

### 4. Use the Shortcode
Add the form to any page or post using:
```html
[custom_contact_form]
```

## Viewing Contact Submissions
1. Log in to WordPress Admin.
2. Click on **Contacts** in the left menu.
3. View submitted contact messages in a table.

## Uninstalling
1. Deactivate the plugin from **WordPress Admin > Plugins**.
2. Delete the `custom-contact-form` folder from `wp-content/plugins/`.

## Contributing
Pull requests are welcome! Feel free to improve the plugin and submit your PRs.

## License
This plugin is open-source and licensed under the MIT License.

