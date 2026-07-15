<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if(!themesflat_get_opt('tf_product_share') || !$product){
    return;
}

$product_url = urlencode( $product->get_permalink() );
$product_title = urlencode( $product->get_name() );

?>

<div class="tf-product-share">
    <ul class="tf-social-icon">
        <?php if( themesflat_get_opt('tf_product_share_facebook') ) : ?>
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url($product_url); ?>" target="_blank" class="social-facebook" rel="noopener">
                    <span class="icon"><i class="icon-facebook"></i></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( themesflat_get_opt('tf_product_share_instagram') ) : ?>
            <li>
                <a href="https://www.instagram.com/?url=<?php echo esc_url($product_url); ?>" target="_blank" class="social-instagram" rel="noopener">
                    <span class="icon"><i class="icon-instagram"></i></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( themesflat_get_opt('tf_product_share_x') ) : ?>
            <li>
                <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url($product_url); ?>&text=<?php echo esc_html($product_title); ?>" target="_blank" class="social-x" rel="noopener">
                    <span class="icon"><i class="icon-x"></i></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( themesflat_get_opt('tf_product_share_snapchat') ) : ?>
            <li>
                <a href="https://www.snapchat.com/scan?attachmentUrl=<?php echo esc_url($product_url); ?>" target="_blank" class="social-snapchat" rel="noopener">
                    <span class="icon"><i class="icon-snapchat"></i></span>
                </a>
            </li>
        <?php endif; ?>

        <?php if( themesflat_get_opt('tf_product_share_linkin') ) : ?>
            <li>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url($product_url); ?>&title=<?php echo esc_html($product_title); ?>" target="_blank" class="social-linkin" rel="noopener">
                    <span class="icon"><i class="icon-linkin"></i></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>