<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

    <!-- Reset Password -->
    <div class="offcanvas offcanvas-end canvas-sidebar" id="reset">
        <div class="canvas-header">
            <h3 class="title fw-normal text-uppercase"><?php esc_html_e( 'Reset password', 'vemus-addon' ); ?></h3>
            <span class="icon-close link icon-close-popup" data-bs-dismiss="offcanvas"></span>
        </div>
        <div class="canvas-body">
            <p class="sub-title text-main-4"><?php esc_html_e( 'Please enter your registered email address to receive an email to reset
                your password', 'vemus-addon' ); ?></p>
            <form method="post" enctype="multipart/form-data" class="tfwc-resset-password form-login form-reset">  
                <div class="form-content">
					<div class="tfwc-message"></div>
                    <fieldset class="tf-field">
                        <input class="tf-input" type="email" name="user_login" placeholder="<?php esc_html_e( 'Enter Your Email*', 'vemus-addon' ); ?>" required>
                        <label class="tf-lable"><?php esc_html_e( 'Email *', 'vemus-addon' ); ?></label>
                    </fieldset>
                </div>
                <button type="submit" class="tf-btn btn-fill w-100 fw-medium animate-btn">
                    <?php esc_html_e( 'SUBMIT', 'vemus-addon' ); ?>
                </button>
            </form>
        </div>
    </div>
    <!-- /Reset Password -->

