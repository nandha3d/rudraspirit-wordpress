<?php
/**
 * Template for displaying wishlist table.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/wishlist/wishlist-table.php.
 *
 * @author  WCBoost
 * @package WCBoost\Wishlist\Templates
 * @version 10.3.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! isset( $wishlist ) ) {
	return;
}
?>

<?php do_action( 'wcboost_wishlist_before_wishlist_table', $wishlist ); ?>

<?php
$GLOBALS['is_wcboost_wishlist_page'] = true;
$wishlist_items = $wishlist->get_items();
$per_page = 8; 
$current_page = max( 1, get_query_var( 'paged', 1 ) );
$total_items = count( $wishlist_items );
$total_pages = ceil( $total_items / $per_page );

$offset = ( $current_page - 1 ) * $per_page;
$paged_items = array_slice( $wishlist_items, $offset, $per_page, true ); 
?>


<div class="wrapper-wishlist tf-grid-layout tf-col-2 md-col-3 xl-col-4" >
    <?php foreach ( $paged_items as $item_key => $item ) :
        $product = $item->get_product();
        if ( ! $product || ! $product->exists() ) continue;
        
        $GLOBALS['product'] = $product;

		$product_style = 'style-1';
		$_POST['product_style'] = $product_style ;

        wc_get_template_part( 'content', 'product' );
		
    endforeach; ?>
</div>
<ul class="page-numbers wishlist">
	<?php
		echo paginate_links( array(
			'base'    => str_replace( 99999, '%#%', esc_url( get_pagenum_link( 99999 ) ) ),
			'format'  => '?paged=%#%',
			'current' => $current_page,
			'total'   => $total_pages,
			'prev_text' => '<i class="icon-arr-left"></i>',
			'next_text' => '<i class="icon-arr-right2"></i>',
		) );
	?>
</ul>

<?php do_action( 'wcboost_wishlist_after_wishlist_table', $wishlist ); ?>

<?php if ( $wishlist->can_edit() && $args['columns']['quantity'] ) : ?>
	<div class="vemus-actions">
		<button type="submit" class="button alt" name="update_wishlist" value="<?php esc_attr_e( 'Update wishlist', 'vemus' ); ?>"><?php esc_html_e( 'Update wishlist', 'vemus' ); ?></button>
		<input type="hidden" name="wishlist_id" value="<?php echo esc_attr( $wishlist->get_id() ); ?>" />
		<?php wp_nonce_field( 'vemus-update' ); ?>
	</div>
<?php endif; ?>
