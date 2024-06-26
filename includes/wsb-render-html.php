<?php
function custom_woocommerce_share_buttons() {
    global $product;
    $product_url = get_permalink($product->get_id());
    $product_title = get_the_title($product->get_id());
    $share_text = 'Check out this product: ';
    $social_links = get_wsb_social_links($product_url, $product_title, $share_text);

    ?>
    <div class="custom-share-buttons">
        <h3>Share this product</h3>
        <?php foreach ($social_links as $link) : ?>
            <a href="<?php echo esc_url($link['url']); ?>" target="_blank" style="color: <?php echo esc_attr($link['color']); ?>; background-color: <?php echo esc_attr($link['bg_color']); ?>; font-size: <?php echo esc_attr($link['icon_size']); ?>px; line-height: <?php echo esc_attr($link['line_height']); ?>px; border-radius: <?php echo esc_attr($link['border_radius']); ?>px;">
                <i class="<?php echo esc_attr($link['icon']); ?>"></i>
            </a>
        <?php endforeach; ?>
    </div>
    <?php
}

