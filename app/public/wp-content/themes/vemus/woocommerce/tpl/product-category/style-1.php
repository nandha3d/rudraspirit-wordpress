<?php
    $show_top_category = themesflat_get_opt('show_top_category');
    if (isset($_GET['show_top_category'])){
        $show_top_category = sanitize_text_field($_GET['show_top_category']);
    }
    if ( $show_top_category != 1 ) return;
    $category_number = themesflat_get_opt('category_number');
    $order_by = themesflat_get_opt('category_order');
    $order = 'ASC';
    if ($order_by == 'count') {
        $order = 'DESC';
    }
    
    $parent_id = 0; 
    if (is_tax('product_cat')) { 
        $current_cat = get_queried_object(); 
        $parent_id = $current_cat->term_id;
    }
    
    $args = array(
        'taxonomy'   => 'product_cat',
        'parent'     => $parent_id,
        'number'     => $category_number,
        'orderby'    => $order_by, 
        'order'      => $order,
        'hide_empty' => false, 
    );
    
    $terms = get_terms($args);

    if ( is_wp_error( $terms ) || ! $terms ) {
        return;
    }

    $thumbnail_size = 'tf-category';

    $term_count = is_array($terms) ? count($terms) : 0;

    $columns = themesflat_get_opt('category_columns');
    $columns = is_string($columns) ? json_decode($columns, true) : $columns;
    $columns = wp_parse_args($columns, [
        'desktop' => 5,
        'tablet'  => 4,
        'mobile_sm'  => 3,
        'mobile'  => 2,
    ]);
    $category_dek = $columns['desktop'];
    $category_tab  = $columns['tablet'];
    $category_mob_sm  = $columns['mobile_sm'];
    $category_mob  = $columns['mobile'];
    if (isset($_GET['category_dek'])){
        $category_dek = sanitize_text_field($_GET['category_dek']);
    }
    if (isset($_GET['category_tab'])){
        $category_tab = sanitize_text_field($_GET['category_tab']);
    }
    if (isset($_GET['category_mob_sm'])){
        $category_mob = sanitize_text_field($_GET['category_mob_sm']);
    }
    if (isset($_GET['category_mob'])){
        $category_mob = sanitize_text_field($_GET['category_mob']);
    }
?>

<div class="tfwc-shop-category">
    <div class="container-6">
        <div class="swiper tf-swiper vemus-swiper" data-preview="<?php echo esc_attr($category_dek); ?>" data-tablet="<?php echo esc_attr($category_tab); ?>" data-mobile-sm="<?php echo esc_attr($category_mob_sm); ?>" data-mobile="<?php echo esc_attr($category_mob); ?>" data-space-lg="30"
            data-space-md="20" data-space="15" data-pagination="2" data-pagination-sm="3" data-pagination-md="4" data-pagination-lg="5" >
            <div class="swiper-wrapper">
                <!-- item 1 -->
                <?php foreach( $terms as $term ) {	
                    $thumb_id = get_term_meta( $term->term_id, 'thumbnail_id', true );
                    $images = ! empty( wp_get_attachment_image_src( $thumb_id, $thumbnail_size ) ) ? wp_get_attachment_image_src( $thumb_id, $thumbnail_size )[0] : wc_placeholder_img_src( $thumbnail_size );
                    $thumb_url = !empty( $thumb_id ) ? $images : wc_placeholder_img_src( $thumbnail_size ); ?>
                    <div class="swiper-slide">
                        <div class="box_collection--V01 style_2 hover-img">
                            <a href="<?php echo esc_url( get_term_link( $term->term_id )); ?>" class="image img-style">
                                <img src="<?php echo esc_url( $thumb_url ); ?>" data-src="<?php echo esc_url( $thumb_url ); ?>" alt="" class=" lazyload">
                            </a>
                            <a href="<?php echo esc_url( get_term_link( $term->term_id )); ?>" class="name-cls link">
                                <span class="h5 fw-normal text-uppercase">
                                    <?php echo esc_html( $term->name );?>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="sw-dot-default d-flex tf-sw-pagination"></div>
        </div>
    </div>
</div>