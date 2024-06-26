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

    $platforms = ['facebook', 'twitter', 'linkedin', 'email', 'instagram', 'pinterest', 'telegram', 'whatsapp'];
    foreach ($platforms as $platform) {
        add_settings_field(
            "wsb_{$platform}_enabled",
            ucfirst($platform),
            "wsb_{$platform}_enabled_render",
            'wsb_settings_group',
            'wsb_settings_section'
        );

        add_settings_field(
            "wsb_{$platform}_style",
            '',
            "wsb_{$platform}_style_render",
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
$platforms = ['facebook', 'twitter', 'linkedin', 'email', 'instagram', 'pinterest', 'telegram', 'whatsapp'];
foreach ($platforms as $platform) {
    $function_code = "
    function wsb_{$platform}_enabled_render() {
        \$options = get_option('wsb_settings');
        ?>
      
        <label class='switch'>
            <input type='checkbox' name='wsb_settings[wsb_{$platform}_enabled]' class='wsb-toggle' <?php checked(isset(\$options['wsb_{$platform}_enabled'])); ?> value='1'>
            <span class='slider round'></span>
        </label>
        <?php
    }

    function wsb_{$platform}_style_render() {
        \$options = get_option('wsb_settings');
        \$enabled = isset(\$options['wsb_{$platform}_enabled']) ? 'block' : 'none';
        ?>
        <div class='wsb-style-controllers' style='display: <?php echo \$enabled; ?>;'>
            <h4><?php echo ucfirst('$platform'); ?> Style Options</h4>
            <table>
            <tr>
                <td>
                <label>Icon Color: </label> 
                </td>
                <td>
                <input type='text' name='wsb_settings[wsb_{$platform}_color]' value='<?php echo isset(\$options['wsb_{$platform}_color']) ? esc_attr(\$options['wsb_{$platform}_color']) : '#ffffff'; ?>' class='wsb-color-field'>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Background Color: </label>
                </td>
                <td>
                    <input type='text' name='wsb_settings[wsb_{$platform}_bg_color]' value='<?php echo isset(\$options['wsb_{$platform}_bg_color']) ? esc_attr(\$options['wsb_{$platform}_bg_color']) : '#0073aa'; ?>' class='wsb-color-field'>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Icon Class: </label>
                </td>
                <td>
                    <input type='text' name='wsb_settings[wsb_{$platform}_icon]' value='<?php echo isset(\$options['wsb_{$platform}_icon']) ? esc_attr(\$options['wsb_{$platform}_icon']) : 'fab fa-{$platform}'; ?>'>
                </td>
            </tr>
            <tr>
                <td>
                     <label>Icon Size: </label>
                </td>
                <td>
                    <input type='number' name='wsb_settings[wsb_{$platform}_icon_size]' value='<?php echo isset(\$options['wsb_{$platform}_icon_size']) ? esc_attr(\$options['wsb_{$platform}_icon_size']) : '20'; ?>'>
                </td>
            </tr>
            
            <tr>
                <td>
                     <label>Line Height: </label>
                </td>
                <td>
                    <input type='number' name='wsb_settings[wsb_{$platform}_line_height]' value='<?php echo isset(\$options['wsb_{$platform}_line_height']) ? esc_attr(\$options['wsb_{$platform}_line_height']) : '20'; ?>'>
                </td>
            </tr>
            <tr>
                <td>
                     <label>Border Radius: </label>
                </td>
                <td>
                    <input type='number' name='wsb_settings[wsb_{$platform}_border_radius]' value='<?php echo isset(\$options['wsb_{$platform}_border_radius']) ? esc_attr(\$options['wsb_{$platform}_border_radius']) : '4'; ?>'>
                </td>
            </tr>

            </table>
            
        </div>

        

        <?php
    }
    ";
    eval($function_code);
}


