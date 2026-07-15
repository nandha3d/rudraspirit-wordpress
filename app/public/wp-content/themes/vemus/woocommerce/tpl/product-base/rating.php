<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $product;




if ( $product->get_rating_count() ) {
    $average_rating = $product->get_average_rating();
    
    $full_stars = floor($average_rating);  
    $percent = ($average_rating - $full_stars) * 100;  
    
    echo '<div class="tf-rating">';
    for ($i = 0; $i < $full_stars; $i++) {
        echo '<span class="icon icon-star full"></span>';  
    }
    if ($percent > 0) {
        echo '<span class="icon icon-star empty"><span class="icon icon-star partial" style="width:' . esc_attr($percent) . '%;"></span></span>'; 
    }

    $empty_stars = 5 - $full_stars - ($percent > 0 ? 1 : 0);
    for ($i = 0; $i < $empty_stars; $i++) {
        echo '<span class="icon icon-star empty"></span>';
    }

    echo '</div>';
}

?>
