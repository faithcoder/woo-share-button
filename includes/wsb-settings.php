<?php
// Add settings page
add_action('admin_menu', 'wsb_add_admin_menu');
add_action('admin_init', 'wsb_settings_init');

function wsb_add_admin_menu() {
    add_options_page('WooCommerce Share Buttons', 'Share Buttons', 'manage_options', 'woocommerce-share-buttons', 'wsb_options_page');
}
function wsb_settings_init() {
    register_setting('wsb_settings_group', 'wsb_settings');

    add_settings_section(
        'wsb_settings_section',
        __('Select Social Platforms and Customize Icons', 'woocommerce-share-buttons'),
        'wsb_settings_section_callback',
        'wsb_settings_group'
    );

    $platforms = ['facebook', 'twitter', 'linkedin', 'email', 'tiktok', 'instagram', 'pinterest', 'telegram', 'whatsapp'];
    foreach ($platforms as $platform) {
        add_settings_field(
            "wsb_{$platform}_enabled",
            ucfirst($platform),
            "wsb_{$platform}_enabled_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );

        add_settings_field(
            "wsb_{$platform}_color",
            ucfirst($platform) . ' Icon Color',
            "wsb_{$platform}_color_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );

        add_settings_field(
            "wsb_{$platform}_bg_color",
            ucfirst($platform) . ' Background Color',
            "wsb_{$platform}_bg_color_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );

        add_settings_field(
            "wsb_{$platform}_icon",
            ucfirst($platform) . ' Icon',
            "wsb_{$platform}_icon_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );

        add_settings_field(
            "wsb_{$platform}_icon_size",
            ucfirst($platform) . ' Icon Size',
            "wsb_{$platform}_icon_size_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );

        add_settings_field(
            "wsb_{$platform}_line_height",
            ucfirst($platform) . ' Line Height',
            "wsb_{$platform}_line_height_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );

        add_settings_field(
            "wsb_{$platform}_border_radius",
            ucfirst($platform) . ' Border Radius',
            "wsb_{$platform}_border_radius_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );
    }
}

function wsb_settings_section_callback() {
    echo __('Select the social platforms you want to enable for sharing, and customize the icon appearance:', 'woocommerce-share-buttons');
}

function wsb_options_page() {
    ?>
    <form action='options.php' method='post'>
        <h2>WooCommerce Share Buttons</h2>
        <?php
        settings_fields('wsb_settings_group');
        do_settings_sections('wsb_settings_group');
        submit_button();
        ?>
    </form>
    <?php
}

// Render functions for settings fields
$platforms = ['facebook', 'twitter', 'linkedin', 'email', 'tiktok', 'instagram', 'pinterest', 'telegram', 'whatsapp'];
foreach ($platforms as $platform) {
    eval("
    function wsb_{$platform}_enabled_render() {
        \$options = get_option('wsb_settings');
        ?>
        <input type='checkbox' name='wsb_settings[wsb_{$platform}_enabled]' <?php checked(isset(\$options['wsb_{$platform}_enabled'])); ?> value='1'>
        <label><?php _e('Enable', 'woocommerce-share-buttons'); ?></label>
        <?php
    }

    function wsb_{$platform}_color_render() {
        \$options = get_option('wsb_settings');
        ?>
        <input type='text' name='wsb_settings[wsb_{$platform}_color]' value='<?php echo isset(\$options['wsb_{$platform}_color']) ? esc_attr(\$options['wsb_{$platform}_color']) : '#ffffff'; ?>' class='wsb-color-field'>
        <?php
    }

    function wsb_{$platform}_bg_color_render() {
        \$options = get_option('wsb_settings');
        ?>
        <input type='text' name='wsb_settings[wsb_{$platform}_bg_color]' value='<?php echo isset(\$options['wsb_{$platform}_bg_color']) ? esc_attr(\$options['wsb_{$platform}_bg_color']) : '#0073aa'; ?>' class='wsb-color-field'>
        <?php
    }

    function wsb_{$platform}_icon_render() {
        \$options = get_option('wsb_settings');
        ?>
        <input type='text' name='wsb_settings[wsb_{$platform}_icon]' value='<?php echo isset(\$options['wsb_{$platform}_icon']) ? esc_attr(\$options['wsb_{$platform}_icon']) : 'fab fa-{$platform}'; ?>'>
        <?php
    }

    function wsb_{$platform}_icon_size_render() {
        \$options = get_option('wsb_settings');
        ?>
        <input type='number' name='wsb_settings[wsb_{$platform}_icon_size]' value='<?php echo isset(\$options['wsb_{$platform}_icon_size']) ? esc_attr(\$options['wsb_{$platform}_icon_size']) : '20'; ?>'>
        <?php
    }

    function wsb_{$platform}_line_height_render() {
        \$options = get_option('wsb_settings');
        ?>
        <input type='number' name='wsb_settings[wsb_{$platform}_line_height]' value='<?php echo isset(\$options['wsb_{$platform}_line_height']) ? esc_attr(\$options['wsb_{$platform}_line_height']) : '20'; ?>'>
        <?php
    }

    function wsb_{$platform}_border_radius_render() {
        \$options = get_option('wsb_settings');
        ?>
        <input type='number' name='wsb_settings[wsb_{$platform}_border_radius]' value='<?php echo isset(\$options['wsb_{$platform}_border_radius']) ? esc_attr(\$options['wsb_{$platform}_border_radius']) : '4'; ?>'>
        <?php
    }
    ");
}

