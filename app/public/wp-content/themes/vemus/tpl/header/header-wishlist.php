<?php
// Wishlist Icon
if ( class_exists( 'WCBoost\Wishlist\Helper' ) ) { 
    $wishlist = \WCBoost\Wishlist\Helper::get_wishlist();
    $wishlist_count = intval( $wishlist->count_items() );

    ?>
    <li class="nav-wishlist d-md-inline-flex">        
        <a href="<?php echo esc_url( wc_get_page_permalink( 'wishlist' ) ); ?>" class="nav-icon-item wishlist-btn-fragment text-black link">
            <i class="icon icon-hearth"></i>
            <span class="count-box whishlist-items-count"><?php echo esc_html( $wishlist_count ); ?></span>
        </a>
    </li>

<?php  } ?>





