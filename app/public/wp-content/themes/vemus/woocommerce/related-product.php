<?php if ( is_page_template( 'tpl/front-page.php' ) || is_404() || get_page_template_slug( get_queried_object_id() ) == 'elementor_header_footer' ) { return; } ?>
<?php
if ( ! get_theme_mod( 'show_related_products' ) )
    return;

if ( get_query_var('paged') ) {
    $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $paged = get_query_var('page');
} else {
    $paged = 1;
}
$args = array(                    
    'post_status'         => 'publish',
    'post_type'           => 'product',
    'paged' => $paged,
    'ignore_sticky_posts' => true,
    'posts_per_page'      => themesflat_get_opt( 'number_related_product_desk' ),
    'post__not_in' => array($post->ID),
); 

$number_desk  = themesflat_get_opt( 'number_related_product_desk' );
$number_tab  = themesflat_get_opt( 'number_related_product_tab' );
$number_mob  = themesflat_get_opt( 'number_related_product_mob' );
    


$categories = (array) get_the_category();

if ( empty( $categories ) )
    return;

$args['category'] = wp_list_pluck( $categories, 'slug' );

$themesflat_thumbnail = 'themesflat-blog-grid';
?>
<div class="section-related-product ">
    <div class="container">
        <div class="col-md-12">
            <div class="box-wrapper">
                <h2 class="box-title"><?php esc_html_e( 'Recently Viewed', 'vemus' ) ?></h2>
                <div class="box-content">
                    <?php
                    $query = new WP_Query($args);
                    if( $query->have_posts() ) { ?>
                         <div class="related-product has-carousel"  data-column="<?php echo esc_attr($number_desk); ?>" data-column2="<?php echo esc_attr($number_tab); ?>" data-column3="<?php echo esc_attr($number_mob); ?>"  >
                            <div class="owl-carousel"> 
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="item">
                                    <article <?php echo esc_attr(post_class('entry'));?>>
                                        <div class="entry-border">
                                            <?php if (has_post_thumbnail()):  ?>
                                            <div class="featured-post">
                                                <a href="<?php the_permalink();?>">
                                                    <?php  the_post_thumbnail( $themesflat_thumbnail ); ?>                                        
                                                </a>
                                                <div class="wrap-btn-action">
                                                    <?php if ( ! $query->managing_stock() && ! $query->is_in_stock() ) { ?>
                                                                
                                                    <?php } else { ?>
                                                    <div class="tf-btn-add-to-cart">
                                                        <span class="add_to_cart button" data-product_id="<?php the_ID(); ?>"><span class="cartplus icon-monal-cart"></span>
                                                            <span class="check icon-monal-check-mark"></span><?php echo esc_html__( '', 'vemus' ) ?></span>
                                                    </div>
                                                    <?php } ?>

                                                    <?php if (class_exists('YITH_WCWL')): ?>            
                                                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist link_classes="add_to_wishlist" label="" product_added_text="" browse_wishlist_text="" already_in_wishslist_text="" icon="fa-heart"]'); ?>
                                                    <?php endif; ?>


                                                    <?php if (function_exists('yith_wcqv_init')): ?>
                                                        <div class="tf-btn-quickview">
                                                            <span class="tf-call-quickview button" data-product_id="<?php the_ID(); ?>"><i class="fas fa-eye"></i></span>
                                                        </div>
                                                    <?php endif; ?>

                                                </div>

                                            </div>
                                            <?php endif; ?>
                                            
                                            <div class="content-post"> 
                                                <p class="category"><?php echo esc_attr ( the_terms( get_the_ID(), 'product_cat', '', ', ', '' ) ); ?></p>
                                                <h6 class="title"><a href="<?php the_permalink();?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h6>           
                                                <p class="price"><?php
                                                    $price = get_post_meta( get_the_ID(), '_price', true); 
                                                    echo "$".$price;
                                                ?></p>                         
                                            </div>  
                                        </div>
                                    </article><!-- /.entry -->
                                </div>
                                <?php endwhile; ?>
                            </div> 
                        <?php  
                    }
                    wp_reset_postdata();            
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


