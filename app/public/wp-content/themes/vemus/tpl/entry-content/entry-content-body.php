<?php
/**
 * @package vemus
 */

if ( is_single() ) {
    echo '<div class="post-content   text-main-6 text-line-clamp-2">';    
        the_content();
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vemus' ),
            'after'  => '</div>',
        ) );
    echo '</div>';

} else {
    echo '<div class="post-content post-excerpt   text-main-6 text-line-clamp-2">';
        if( strpos( get_the_content(), 'more-link' ) === false ) {
            add_filter( 'excerpt_more', 'themesflat_excerpt_not_more' );
            the_excerpt();     
        } else {
            add_filter( 'the_content_more_link', 'themesflat_excerpt_not_more' );
            the_content();
        }
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vemus' ),
            'after'  => '</div>',
        ) );
    echo '</div>';
}


