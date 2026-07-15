<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     10.3.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}


function tfwc_woo_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>    
	<li <?php comment_class('post-review-item'); ?> id="comment-<?php comment_ID() ?>">
		<div class="gravatar rv-image">
			<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, 96 ); ?> 
		</div>
		<div class='comment_content rv-content'>		
			<div class="d-flex align-items-center justify-content-between flex-wrap">
				<ul class="meta">
					<?php printf( '<li class="entry_name h6 comment_author">%s</li>', get_comment_author_link()); ?><?php edit_comment_link(esc_html__('(Edit)', 'vemus' ),'  ','') ?>
					<li class="br-line"></li>
					<li class="comment_time entry_date"><span><?php echo date('M jS, Y', strtotime(get_comment_date('F j, Y'))); ?></span></li>
					<?php 
					$rating = get_comment_meta( $comment->comment_ID, 'rating', true ); 
					if ( $rating ) : ?>
						<div class="comment_rating">
							<div class="stars rate-wrap align-items-center">
								<?php 
								for ( $i = 1; $i <= 5; $i++ ) {
									echo wp_kses_post(( $i <= $rating ) ? '<i class="icon icon-star full"></i>' : '<i class="icon icon-star"></i>');
								}
								?>
							</div>
						</div>
					<?php endif; ?>
				</ul>
			</div>

			<div class='comment_text rv-text h6'>
				<?php comment_text() ?>
			<?php if ($comment->comment_approved == '0') : ?>
				<span class="unapproved"><?php esc_html_e( 'Your comment is awaiting moderation.', 'vemus') ?></span>
			<?php endif; ?>					
			</div>


		</div>
	</li>
<?php
}

?>


<div id="reviews" class="woocommerce-Reviews">
	<!-- <div class=""> -->
		<div class="accordion-body">
			<?php
			global $wpdb;
			global $post;
			global $product;
			$count = $wpdb->get_var("
				SELECT COUNT(meta_value) FROM $wpdb->commentmeta
				LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				WHERE meta_key = 'rating'
				AND comment_post_ID = $post->ID
				AND comment_approved = '1'
				AND meta_value > 0
			");

			$sql = $wpdb->prepare( "
				SELECT meta_value 
				FROM {$wpdb->prefix}commentmeta 
				INNER JOIN {$wpdb->prefix}comments ON {$wpdb->prefix}commentmeta.comment_id = {$wpdb->prefix}comments.comment_ID 
				WHERE comment_post_ID = %d AND meta_key = 'rating' ", get_the_ID() 
			);
			$results = $wpdb->get_results( $sql );
			$rating5 = 0;
			$rating4 = 0;
			$rating3 = 0;
			$rating2 = 0;
			$rating1 = 0;

			foreach($results as $result){
				if( $result->meta_value == '5' ) {
					$rating5++;
				} else if( $result->meta_value == '4' ) {
					$rating4++;
				} else if( $result->meta_value == '3' ) {
					$rating3++;
				} else if( $result->meta_value == '2' ) {
					$rating2++;
				} else if( $result->meta_value == '1' ) {
					$rating1++;
				}

			}
			$review_count = $product->get_review_count();
			$rating = $wpdb->get_var("
				SELECT SUM(meta_value) FROM $wpdb->commentmeta
				LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
				WHERE meta_key = 'rating'
				AND comment_post_ID = $post->ID
				AND comment_approved = '1'
			");

			echo '<div class="wd-rating-review">';
				if ( $count > 0 ) {
					$product_id = $product->get_id();
					$review_count = $product->get_review_count();
					$average = number_format($rating / $count, 1);
					$stock_sold = ( $total_sales = get_post_meta( $product_id, 'total_sales', true ) ) ? round( $total_sales ) : 0;
					$url = home_url( '/' );
				
					?>
					<div class="rate-head" >
						<ul class="product-info-rate rate-wrap align-items-center">
							<?php woocommerce_template_single_rating(); ?>
							(<?php echo esc_html($review_count); ?>)
						</ul>
						<p>
							<?php echo esc_html($average); ?>/5.0
						</p>
					</div>

					<?php
					
					?>
					<ul class="rating-progress">
						<li>
							<div class="rate-number">
								<span><?php _e('5', 'vemus' ); ?></span>
								<i class="icon-star full"></i>
							</div>
							<span class="line-progress-rate progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
								<span class="progress-bar" style="width:<?php echo esc_attr($rating5*100/$review_count); ?>%;"></span>
							</span>
							<span class="rate-count"><?php echo esc_html($rating5); ?></span>
						</li>
						<li>
							<div class="rate-number">
								<span><?php _e('4', 'vemus' ); ?></span>
								<i class="icon-star full"></i>
							</div>
							<span class="line-progress-rate progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
								<span class="progress-bar" style="width:<?php echo esc_attr($rating4*100/$review_count); ?>%;"></span>
							</span>
							<span class="rate-count"><?php echo esc_html($rating4); ?></span>
						</li>
						<li>
							<div class="rate-number">
								<span><?php _e('3', 'vemus' ); ?></span>
								<i class="icon-star full"></i>
							</div>
							<span class="line-progress-rate progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
								<span class="progress-bar" style="width:<?php echo esc_attr($rating3*100/$review_count); ?>%;"></span>
							</span>
							<span class="rate-count"><?php echo esc_html($rating3); ?></span>
						</li>
						<li>
							<div class="rate-number">
								<span><?php _e('2', 'vemus' ); ?></span>
								<i class="icon-star full"></i>
							</div>
							<span class="line-progress-rate progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
								<span class="progress-bar" style="width:<?php echo esc_attr($rating2*100/$review_count); ?>%;"></span>
							</span>
							<span class="rate-count"><?php echo esc_html($rating2); ?></span>
						</li>
						<li>
							<div class="rate-number">
								<span><?php _e('1', 'vemus' ); ?></span>
								<i class="icon-star full"></i>
							</div>
							<span class="line-progress-rate progress" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
								<span class="progress-bar" style="width:<?php echo esc_attr($rating1*100/$review_count); ?>%;"></span>
							</span>
							<span class="rate-count"><?php echo esc_html($rating1); ?></span>
						</li>
					</ul>

					<a href="#review_form" class="tf-btn fw-medium ">
						<?php _e('write a review', 'vemus'); ?>
					</a>
				<?php
				}
			echo '</div>';
			?>
			<div class="box-preview-wrapper">
				<div id="comments" class="comments-area">
					<div class="review-post-list">
						<?php if ( have_comments() ) : ?>

							<h5 class="title"><?php echo esc_html($review_count); ?> 
							<?php echo _n( 'review', 'reviews', $review_count, 'vemus' ); ?>
						</h5>
							<ul class="">
								<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'tfwc_woo_comments' ) ) ); ?>
							</ul>

							<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
								echo '<nav class="woocommerce-pagination">';
								paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
									'prev_text' => '&larr;',
									'next_text' => '&rarr;',
									'type'      => 'list',
								) ) );
								echo '</nav>';
							endif; ?>

						<?php else : ?>

							<p class="woocommerce-noreviews"><?php echo esc_html__( 'There are no reviews yet.', 'vemus' ); ?></p>

						<?php endif; ?>
					</div>
				</div>

				<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

					<div id="review_form_wrapper">
						<div id="review_form" class="review-post-comment">
							<?php
								$commenter = wp_get_current_commenter();

								$comment_form = array(
									'title_reply'          => have_comments() ? esc_html__( 'Write a review', 'vemus' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'vemus' ), get_the_title() ),
									'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'vemus' ),
									'title_reply_before'   => '<p id="reply-title" class="title h5">',
									'title_reply_after'    => '</p><p class="sub-title h6">Your email address will not be published.&nbsp;Required fields are marked&nbsp;*</p>',
									'comment_notes_after'  => '',
									'fields'               => array(
										'author' => '<div class="cols tf-grid-layout sm-col-2 tf-comment-name-wrapper order-1">
											<fieldset class="name-container"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required placeholder="' . esc_attr__( 'Name *', 'vemus' ) . '" /></fieldset>',
										'email'  => '<fieldset class="email-container"><input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required placeholder="' . esc_attr__( 'Email *', 'vemus' ) . '" /></fieldset></div>',
										// 'save' => '<div class="checkbox-wrap order-3">
                                        //     <input id="save" name="save" type="checkbox" class="tf-check style-2 p-0">
                                        //     <label for="save" class="h6 fw-normal">Save my name, email, and website in this browser for the next time I comment.</label>
                                        // </div>'
									),
									'label_submit'  => esc_html__( 'Submit', 'vemus' ),
									'class_submit' => 'tf-btn btn-fill-2 fw-medium animate-btn',
									'submit_field' => '<p class="form-submit order-4">%1$s %2$s</p>',
									'logged_in_as'  => '',
									'comment_field' 		=> '',
									'comment_notes_before' => '',
									'comment_notes_after'  => '',
									'class_form' => 'tf-comment-form form-review style-border form-action',
								);

								if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
									$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.', 'vemus' ), esc_url( $account_page_url ) ) . '</p>';
								}

								if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
									$comment_form['comment_field'] = '<div class="comment-form-rating your-rate">
															<span class="fw-normal h6">' . esc_html__( 'Your rating *', 'vemus' ) . '</span>
															<div class="rate-wrap handle-rating stars custom-star" role="group" aria-labelledby="comment-form-rating-label">
																<a href="#" class="star" data-rating="1" title="1 star"><i class="icon icon-star"></i></a>
																<a href="#" class="star" data-rating="2" title="2 stars"><i class="icon icon-star"></i></a>
																<a href="#" class="star" data-rating="3" title="3 stars"><i class="icon icon-star"></i></a>
																<a href="#" class="star" data-rating="4" title="4 stars"><i class="icon icon-star"></i></a>
																<a href="#" class="star" data-rating="5" title="5 stars"><i class="icon icon-star"></i></a>
															</div>
															<input type="text" name="rating" id="rating" value="" class="screen-reader-text" required />
														</div>';
								}

								

								$comment_form['comment_field'] .= '<div class="order-2"><fieldset class="comment-form-comment message"> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder=" '. esc_attr__( 'Your Review*', 'vemus' ) . '"></textarea></p></div>';

								

								comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
					
							?>
						</div>
					</div>

				<?php else : ?>

					<p class="woocommerce-verification-required"><?php echo esc_html__( 'Only logged in customers who have purchased this product may leave a review.', 'vemus' ); ?></p>

				<?php endif; ?>
			</div>
			<div class="clear"></div>
		</div>
	<!-- </div> -->
</div>
