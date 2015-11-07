// Woocommerce theme support for Genesis
add_theme_support( 'genesis-connect-woocommerce' );

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 2; // 3 products per row
	}
}

//* Display Woocommerce category on archive page
function wc_category_title_archive_products(){

    $product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $product_cats && ! is_wp_error ( $product_cats ) ){
        $single_cat = array_shift( $product_cats );
        
        echo '<span class="atmosphere-large-text">';
        echo $single_cat->name;
        echo '</span>';
	}
}
add_action( 'woocommerce_before_shop_loop_item_title', 'wc_category_title_archive_products', 10 );

// Display Woocommerce Short Product description on Catalog
add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_single_excerpt', 0);
	function woocommerce_template_single_excerpt() { 
		echo '<span class="title-description">';
		echo substr(get_the_excerpt(), 0, 200);
		echo '</span><br />';
}

//* Change number of related products output
function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 2;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 2; // 2 related products
	$args['columns'] = 2; // arranged in 2 columns
	return $args;
}
