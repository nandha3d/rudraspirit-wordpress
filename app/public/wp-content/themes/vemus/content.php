<?php
/**
 * @package vemus
 */
?>
	<?php 

	$count = get_query_var( 'count' );

	$blog_archive_layout = themesflat_get_opt('blog_archive_layout');
	if (isset($_GET['blog_archive_layout'])){
		$blog_archive_layout = sanitize_text_field($_GET['blog_archive_layout']);
	}

	$blog_grid_style = themesflat_get_opt('blog_grid_style');
	if (isset($_GET['blog_grid_style'])){
		$blog_grid_style = sanitize_text_field($_GET['blog_grid_style']);
	}

	if ($blog_grid_style == 'style-1') {
		$box_style = 2;
	} else {
		$box_style = 1;
	}

	$class_post = "";

	if ($blog_grid_style == 'style-1' && $count == 3) {
		$class_post = "article-blog hover-img wd-full";
	}elseif ($blog_grid_style == 'style-2' && $count == 1) {
		$class_post = "article-blog style-row hover-img wd-full";
	}elseif ($blog_grid_style == 'style-2' && $count != 1) {
		$class_post = "article-blog hover-img style-row-2";
	}else {
		$class_post = "article-blog hover-img";
	}

	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class($class_post); ?>>
			<?php get_template_part( 'tpl/feature-post'); ?>
			
			<div class="blog-content content-post">
				<?php 
				$content_elements = themesflat_layout_draganddrop(themesflat_get_opt( 'post_content_elements' ));
				foreach ( $content_elements as $content_element ) :
					if ( 'title' == $content_element ) {
						get_template_part( 'tpl/entry-content/entry-content-title' );
					} elseif ( 'meta' == $content_element ) {
						get_template_part( 'tpl/entry-content/entry-content-meta' );
					}  elseif ( 'excerpt_content' == $content_element ) {
						get_template_part( 'tpl/entry-content/entry-content-body' );
					} elseif ( 'readmore' == $content_element ) {
						get_template_part( 'tpl/entry-content/entry-content-readmore' );
					}
				endforeach;
				?>
			</div>
		
	</article>
