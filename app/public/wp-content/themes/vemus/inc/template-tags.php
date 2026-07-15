<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package vemus
 */


/**
 * Prints HTML with meta information for the current post-date/time, post categories and author.
 */

function themesflat_widget_layout($columns) {
	$layout = array();
	switch ($columns) {
		case 1:
			$layout = array(12);
			break;
		case 2:
			$layout = array(6,6);
			break;
		case 3:
			$layout = array(4,4,4);
			break;
		case 4:
			$layout = array(3,2,3,4);
			break;
		case 5:
			$layout = array(3,3,3,3);
			break;
		case 6:
			$layout = array(2,2,2,2,2);
			break;
		default:
			$layout = array(12);
			break;
		
	}
	return $layout;
}

if ( ! function_exists( 'themesflat_posted_category' ) ) :
function themesflat_posted_category( $layout = '' ) { 	
	if ( has_category() ) {
		echo '<div class="post-categories">'.esc_html__("In - ",'vemus');
			the_category( ', ' );
		echo '</div>';
	}	
}
endif;

if ( ! function_exists( 'themesflat_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function themesflat_entry_footer() {

	
		
	
	?>
                      
                        
                    
	<footer class="entry_media">
		<?php
		if ( 'post' == get_post_type() ) {

			$tags_list = get_the_tags();
						
			if ( $tags_list && is_single() ) {
		?>
			<ul class="entry_tag">
				<?php foreach ($tags_list as $tag) { ?>				
				<li>
					<a href="<?php echo esc_url(get_tag_link($tag->term_id));?>" class="text-caption">
						<?php echo esc_html($tag->name);?>
					</a>
				</li>
				<?php }	?>
			</ul>

		<?php 
			}			
		}
	
			themesflat_social_single();
		?>
	</footer>
	<?php

}
endif;

if ( ! function_exists( 'themesflat_post_navigation' ) ) :
function themesflat_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();

    if ( ! $prev_post && ! $next_post ) {
        return;
    }

    $container_class = '';
    if ( empty( $prev_post ) && ! empty( $next_post ) ) {
        $container_class = 'navi-next';
    }
    ?>
    <div class="related-post post-navigator <?php echo esc_attr( $container_class ); ?>">
        <?php if ( $prev_post ) : ?>
            <a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" class="post prev text-black link">
                <span class="icon"><i class="icon-arrow-left"></i></span>
                <p class="fw-normal"><?php esc_html_e( 'PREVIOUS POST', 'vemus' ); ?></p>
            </a>
        <?php endif; ?>

        <?php if ( $next_post ) : ?>
            <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" class="post next text-black link">
                <p class="fw-normal"><?php esc_html_e( 'NEXT POST', 'vemus' ); ?></p>
                <span class="icon"><i class="icon-arrow-right"></i></span>
            </a>
        <?php endif; ?>
    </div>
    <?php
}
endif;
