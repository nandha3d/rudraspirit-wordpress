<?php

defined( 'ABSPATH' ) || exit;

global $product;

if( empty($product) ){
    return;
}

$pickup_locations = get_option('pickup_location_pickup_locations');

if ( empty( $pickup_locations ) ) return;

?>
<?php
$pickup_locations = get_option('pickup_location_pickup_locations');
?>

<div class="tf-product-pickup-store">
    <ul class="store-pickup-list">
        <?php foreach ( $pickup_locations as $location ) : ?>
            <?php
            $address = $location['address'] ?? [];
            ?>
            <li class="store-pickup-item">
                <span class="dot"></span>
                <div class="store-info">
                    <p class="address-avaiable fw-normal">
                        <?php _e('Pickup available at', 'vemus'); ?>
                        <a href="#pickUp" data-bs-toggle="offcanvas" target="_blank" class="h6 link">
                            <?php echo esc_html( $address['address_1'] ); ?>
                        </a>
                    </p>
                    <p class="address-ready text-caption text-main-4">
                        <?php _e('Usually ready in 24 hours', 'vemus'); ?>
                    </p>
                    <a href="#pickUp" data-bs-toggle="offcanvas" class="tf-btn-line style-line-2">
                        <span class="text-caption fw-normal">
                            <?php _e('View store information', 'vemus'); ?>
                        </span>
                    </a>
                </div>
            </li>
            <?php break; ?>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Modal -->
<div class="offcanvas offcanvas-end canvas-sidebar canvas-pickup" id="pickUp" aria-modal="true" role="dialog">
    <div class="canvas-header">
        <span class="h3 title fw-normal text-uppercase">
            <?php _e('Pickup available', 'vemus'); ?>
        </span>
        <span class="icon-close link icon-close-popup" data-bs-dismiss="offcanvas"></span>
    </div>
    <div class="canvas-body">
        <ul class="store-list">
            <?php foreach ( $pickup_locations as $location ) : ?>
                <?php
                $address = $location['address'] ?? [];
                ?>
                <li class="store-ready-item">
                    <span class="title h5 fw-normal text-uppercase">
                        <?php echo esc_html($location['name'] ?? ''); ?>
                    </span>
                    <div class="store-status">
                        <span class="icon">
                            <i class="icon-check-2"></i>
                        </span>
                        <p class="text">
                            <?php _e('Pickup available. Usually ready in 24 hours', 'vemus'); ?>
                        </p>
                    </div>
                    <p class="text-main-4">
                        <?php echo esc_html($address['address_1'] ?? ''); ?>
                        <br>
                        <?php echo esc_html($address['city'] ?? ''); ?> <?php echo esc_html($address['postcode'] ?? ''); ?>
                        <br>
                        <?php echo esc_html($address['country'] ?? ''); ?>
                        <br>
                        <?php echo wp_kses_post($location['details'] ?? ''); ?>
                    </p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>