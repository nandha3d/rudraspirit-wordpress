<?php
/**
 * @package vemus
 */

$themesflat_thumbnail = 'themesflat-blog-single';

?>
					<div class="single-wrap">
						<div class="box-title">
							<ul class="entry_meta">
								<!-- Author -->
								<li>
									<span class="icon">
										<i class="icon-author"></i>
									</span>
									<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>" class="link">
										<?php _e('By', 'vemus'); ?> <?php the_author(); ?>
									</a>
								</li>

								<!-- Date -->
								<li>
									<span class="icon">
										<i class="icon-calender"></i>
									</span>
									<p><?php echo get_the_date( 'd M y' ); ?></p>
								</li>

								<!-- Categories -->
								<li>
									<span class="icon">
										<i class="icon-tag"></i>
									</span>
									<p>
										<?php
										$categories = get_the_category();
										if ( $categories ) {
											echo esc_html( implode( ', ', wp_list_pluck( $categories, 'name' ) ) );
										}
										?>
									</p>
								</li>

								<!-- Comment Count -->
								<li>
									<span class="icon">
										<i class="icon-comment"></i>
									</span>
									<p>
										<?php
										$comments_count = get_comments_number();
										if ( $comments_count == 0 ) {
											echo 'No Comment';
										} elseif ( $comments_count == 1 ) {
											echo '1 Comment';
										} else {
											echo esc_html( $comments_count ) . ' Comments';
										}
										?>
									</p>
								</li>
							</ul>
						</div>

						<?php if( themesflat_get_opt('show_entry_title_single') == 1 ): ?>		
							<!-- Post Title -->
							<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php endif; ?>

						<?php get_template_part( 'tpl/feature-post-single'); ?> 
					</div>

	<div class="main-post">		
		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'vemus' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>'
				) );
				?>
		</div><!-- .entry-content -->
	</div><!-- /.main-post -->


<?php if( themesflat_get_opt('show_entry_footer_content') == 1 ): ?>		
	<?php themesflat_entry_footer(); ?>
<?php endif; ?>