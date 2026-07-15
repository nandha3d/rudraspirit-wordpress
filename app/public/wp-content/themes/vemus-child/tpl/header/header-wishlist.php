<?php
/**
 * Antigravity Override:
 * Displays the Alpine.js powered wishlist count in the header.
 * Removes dependency on WCBoost plugin.
 */
?>
<li class="nav-wishlist d-md-inline-flex" x-data>        
    <a href="<?php echo esc_url( home_url( '/wishlist' ) ); ?>" class="nav-icon-item wishlist-btn-fragment text-black link">
        <i class="icon icon-hearth"></i>
        <span class="count-box whishlist-items-count" 
              x-text="$store.wishlist.items.length" 
              x-show="$store.wishlist.items.length > 0"
              style="display: none;" 
              x-show.important="$store.wishlist.items.length > 0">
            0
        </span>
    </a>
</li>
