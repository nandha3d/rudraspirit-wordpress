<?php
$feature_post = '';

$blog_layout = themesflat_get_opt('blog_archive_layout');
if (isset($_GET['blog_layout'])){
	$blog_layout = sanitize_text_field($_GET['blog_layout']);
}


$blog_list_style = themesflat_get_opt('blog_list_style');
if (isset($_GET['blog_list_style'])){
	$blog_archive_layout = sanitize_text_field($_GET['blog_list_style']);
}

$size =  'themesflat-blog';

$thumb = get_the_post_thumbnail( get_the_ID(), $size );
if ( empty( $thumb ) )
	return;
	
$feature_post .= get_the_post_thumbnail( get_the_ID(), $size );
?>


<div class="entry_image">
    <a href="<?php echo esc_url( get_permalink() ); ?>" class="image img-style">
        <?php echo wp_kses_post( $feature_post ); ?>
    </a>
    <?php
    $tags = get_the_tags();
    if ( $tags && ! is_wp_error( $tags ) ) :
    ?>
        <div class="entry_tag">
            <?php foreach ( $tags as $tag ) : ?>
                <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" 
                   class="name-tag text-caption link">
                    <?php echo esc_html( $tag->name ); ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
