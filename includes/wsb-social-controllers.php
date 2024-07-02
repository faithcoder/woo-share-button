<?php
function get_wsb_social_links($product_url, $product_title, $share_text) {
    $options = get_option('wsb_settings');
    $platforms = ['facebook', 'twitter', 'linkedin', 'instagram', 'pinterest', 'telegram', 'whatsapp'];

    $social_links = [];

    foreach ($platforms as $platform) {
        if (isset($options["wsb_{$platform}_enabled"])) {
            $icon = isset($options["wsb_{$platform}_icon"]) ? esc_attr($options["wsb_{$platform}_icon"]) : "fab fa-{$platform}";
            $color = isset($options["wsb_{$platform}_color"]) ? esc_attr($options["wsb_{$platform}_color"]) : '#ffffff';
            $bg_color = isset($options["wsb_{$platform}_bg_color"]) ? esc_attr($options["wsb_{$platform}_bg_color"]) : '#0073aa';
            $icon_size = isset($options["wsb_{$platform}_icon_size"]) ? esc_attr($options["wsb_{$platform}_icon_size"]) : '20';
            $line_height = isset($options["wsb_{$platform}_line_height"]) ? esc_attr($options["wsb_{$platform}_line_height"]) : '20';
            $border_radius = isset($options["wsb_{$platform}_border_radius"]) ? esc_attr($options["wsb_{$platform}_border_radius"]) : '4';

            $url = '';
            switch ($platform) {
                case 'facebook':
                    $url = "https://www.facebook.com/sharer.php?u=" . urlencode($product_url);
                    break;
                case 'twitter':
                    $url = "https://twitter.com/share?url=" . urlencode($product_url) . "&text=" . urlencode($share_text . $product_title);
                    break;
                case 'linkedin':
                    $url = "https://www.linkedin.com/shareArticle?mini=true&url=" . urlencode($product_url) . "&title=" . urlencode($product_title);
                    break;
                case 'instagram':
                    $url = "https://www.instagram.com/?url=" . urlencode($product_url);
                    break;
                case 'pinterest':
                    $url = "https://pinterest.com/pin/create/button/?url=" . urlencode($product_url) . "&description=" . urlencode($share_text . $product_title);
                    break;
                case 'telegram':
                    $url = "https://t.me/share/url?url=" . urlencode($product_url) . "&text=" . urlencode($share_text . $product_title);
                    break;
                case 'whatsapp':
                    $url = "https://wa.me/?text=" . urlencode($share_text . $product_title . ': ' . $product_url);
                    break;
            }

            $social_links[] = [
                'url' => $url,
                'icon' => $icon,
                'color' => $color,
                'bg_color' => $bg_color,
                'icon_size' => $icon_size,
                'line_height' => $line_height,
                'border_radius' => $border_radius
            ];
        }
    }

    return $social_links;
}

