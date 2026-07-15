<?php
/**
 * The template for displaying all single posts.
 *
 * @package vemus
 */

get_header(); ?>
<section class="flat-spacing">
	<div class="container">
		<div class="s-blog-detail align-items-start">
			<div class="blog-single">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'single' ); ?>
							<div class="main-single">	
								
							<?php 			

								if ( 'post' == get_post_type() && themesflat_get_opt('show_post_navigator' ) == 1 ): 

									themesflat_post_navigation(); 				

								endif;

							?>

							
							<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							?>

							</div>	
						<?php endwhile; ?>
			</div>
			<div class="blog-sidebar sidebar-content-wrap d-none d-lg-block sticky-top">

					<?php if ( is_single() ) : 
						$author_id = get_the_author_meta('ID');
						$author_name = get_the_author();
						$author_avatar = get_avatar( $author_id, 200 );

						$author_duty = get_user_meta( $author_id, 'author_duty', true ); 
						$author_facebook = get_user_meta( $author_id, 'author_facebook', true ); 
						$author_instagram = get_user_meta( $author_id, 'author_instagram', true ); 
						$author_x = get_user_meta( $author_id, 'author_x', true ); 
					?>
				<div class="sidebar-item">
					<div class="sb-author text-center">
						<div class="entry_author">
							<div class="avatar">
								<?php echo wp_kses_post($author_avatar); ?>
							</div>
							<div class="infor">
								<p class="name"><?php echo esc_html( $author_name ); ?></p>
								<?php if ( $author_duty ) : ?>
									<p class="duty text-main-4"><?php echo esc_html( $author_duty ); ?></p>
								<?php endif; ?>
							</div>
						</div>
						<ul class="tf-social-icon">
							<?php if ( $author_facebook ) : ?>
							<li>
								<a href="<?php echo esc_url( $author_facebook ); ?>" target="_blank" class="social-facebook">
									<span class="icon"><i class="icon-facebook"></i></span>
								</a>
							</li>
							<?php endif; ?>

							<?php if ( $author_instagram ) : ?>
							<li>
								<a href="<?php echo esc_url( $author_instagram ); ?>" target="_blank" class="social-instagram">
									<span class="icon"><i class="icon-instagram"></i></span>
								</a>
							</li>
							<?php endif; ?>

							<?php if ( $author_x ) : ?>
							<li>
								<a href="<?php echo esc_url( $author_x ); ?>" target="_blank" class="social-x">
									<span class="icon"><i class="icon-x"></i></span>
								</a>
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
					<?php endif; ?>

				<?php dynamic_sidebar('blog-sidebar'); ?>
			</div>
		</div>
	</div>
</section>

<div class="btn-sidebar-mb d-lg-none right">
    <button data-bs-toggle="offcanvas" data-bs-target="#mbSidebar">
        <i class="icon icon-sidebar"></i>
    </button>
</div>


<div class="offcanvas offcanvas-end canvas-sidebar" id="mbSidebar" aria-modal="true" role="dialog">
	<div class="canvas-wrapper">
		<div class="canvas-header">
			<span class="title"><?php echo esc_html__('SIDEBAR','vemus')?></span>
			<span class="icon-close link icon-close-popup" data-bs-dismiss="offcanvas"></span>
		</div>
		<div class="canvas-body sidebar-mobile-append blog-sidebar"> 
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div>
</div>

<?php get_footer(); ?>