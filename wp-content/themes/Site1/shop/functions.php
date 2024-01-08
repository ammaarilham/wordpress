<?php
// add custom urls for product and products templates
if ( ! function_exists( 'shop_templates_url_init' )) {
    function shop_templates_url_init() {
        add_rewrite_tag('%product-id%','([^/]+)');
        add_rewrite_rule('^product-id/([^/]+)/?','index.php?product-id=$matches[1]', 'top');
        add_rewrite_tag('%products-list%','([^/]+)');
        add_rewrite_rule('^products-list/([^/]+)/?','index.php?products-list=$matches[1]', 'top');
    }
    add_action('init', 'shop_templates_url_init');
}
// require product and products templates
if ( ! function_exists( 'shop_custom_templates' )) {
    function shop_custom_templates($template) {
        $path = false;
        if ( get_query_var('product-id', null) !== null ) {
            $path = '/shop/product.php';
        }
        if ( get_query_var('products-list', null) !== null ) {
            $path = '/shop/products.php';
        }
        if ($path) {
            $template = get_template_directory() . $path;
        }
        return $template;
    }
    add_filter('template_include', 'shop_custom_templates', 50);
}

if ( ! function_exists( 'get_product_data' )) {
    function get_product_data($product, $productId) {
        $productData = array();
        $productData['title'] = isset($product['title']) ? $product['title'] : '';
        $productData['desc'] = isset($product['description']) ? $product['description'] : '';
        $productData['price'] = isset($product['fullPrice']) ? addcslashes($product['fullPrice'], '$\\') : '';
        $productData['price_old'] = isset($product['price_old']) ? addcslashes($product['price_old'], '$\\') : '';
        $productData['images'] = isset($product['images']) ? $product['images'] : array();
        $productData['image_url'] = isset($product['images']) && count($product['images']) > 0 ? array_shift($product['images'])['url'] : '';
        $productData['productUrl'] = $productId ? home_url('?product-id=' . $productId) : '#';
        $productData['add_to_cart_text'] = 'Add to Cart';
        return $productData;
    }
}