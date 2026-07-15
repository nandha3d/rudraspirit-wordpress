<?php
// Cart Icon
if ( class_exists( 'YITH_Woocompare' ) ) { ?>
    <div class="header-wishlist-wrapper">
        <a class="nav-wishlist-trigger" href="?action=yith-woocompare-view-table" >
            <?php echo themesflat_svg( 'wishlist' ); ?>
            
                <?php  function my_function() {
                    echo do_shortcode('[yith_woocompare_counter]');
                    }
                                
                add_action('wp', 'my_function');  ?>
        </a>
    </div>
   
<?php  }  
?>
