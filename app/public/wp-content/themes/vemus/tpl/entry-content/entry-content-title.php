<?php  
/**
 * @package vemus
 */
?>
						
<?php
if ( is_singular('post') ) :						
	the_title( '<h4 class="entry-title">', '</h4>' );
else :
	the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark" class="link fw-medium text-black text-uppercase">', esc_url( get_permalink() ) ), '</a></h4>' );
endif;
?>	