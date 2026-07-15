<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
if ( $product->get_stock_status() == 'outofstock' ) { ?>    
    <div class="out-stock stock  text-line-clamp-1">
        <span class="dot"></span>  
        <?php echo esc_html__('Out of stock','vemus');?>
        <!-- <a href="#unavailable" data-bs-toggle="modal" class="variant-box stock bg-main link text-white">
            <p class="text-center d-none d-md-block"><?php _e('Notify Me When Available','vemus');?></p>
            <p class="text-center d-md-none"><?php _e('Notify Me','vemus');?></p>
        </a> -->
    </div>
<?php   
} else if( $product->is_in_stock() &&  ! $product->is_on_backorder() && $product->is_purchasable() ) { ?>
    <div class="in-stock stock  text-line-clamp-1">
        <span class="dot"></span> 
        <?php echo esc_html__('In stock, ready to ship','vemus');?>
    </div> 
<?php  } ?>

