<?php

class Vemus_Footer_Bottom extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null) {
		parent::__construct( $data, $args );
    }

	/**
	 * Get widget name.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'vemus_footer_bottom';
	}

	/**
	 * Get widget title.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Vemus Footer Bottom', 'vemus-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-call-to-action';
	}

	/**
	 * Get widget categories.
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'vemus_addons_core' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['footer' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Footer Bottom', 'vemus-addon'),
	            ]
	        );

            $this->add_control(
                'show_copyright',
                [ 
                    'label'        => esc_html__( 'Show Copyright', 'vemus-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'vemus-addon' ),
                    'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes'
                ]
            );

            $this->add_control(
                'show_currency',
                [ 
                    'label'        => esc_html__( 'Show Currency', 'vemus-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'vemus-addon' ),
                    'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes'
                ]
            );

            $this->add_control(
                'show_payment',
                [ 
                    'label'        => esc_html__( 'Show Payment', 'vemus-addon' ),
                    'type'         => \Elementor\Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'On', 'vemus-addon' ),
                    'label_off'    => esc_html__( 'Off', 'vemus-addon' ),
                    'return_value' => 'yes',
                    'default'      => 'yes'
                ]
            );

            $this->add_control(
                'copyright',
                [
                    'label' => esc_html__('Copyright', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'All Rights Reserved 2025 VEMUS.',
                    'label_block' => true,
                    'condition' => [
                        'show_copyright'	=> 'yes',
                    ],
                ]
            );

       

        $this->end_controls_section();

        $this->start_controls_section( 'section_footer',
            [
                'label' => esc_html__('Style', 'vemus-addon'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-footer' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

         $this->add_control(
			'heading_text_copyright',
			[
				'label' => esc_html__( 'Text', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography_copyright',
				'selector' => '{{WRAPPER}} .tf-footer .text-nocopy',
			]
		);

        // Text color
        $this->add_control(
            'text_color_copyright',
            [
                'label' => esc_html__('Text Color', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tf-footer .text-nocopy' => 'color: {{VALUE}} !important;',
                ],
            ]
        );



        $this->end_controls_section();



	}

	/**
	 * Render vemus Button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render(): void {
    $settings = $this->get_settings_for_display();
    ?>

        <!-- Footer -->
        <footer class="tf-footer style-2 bg-dark-brown ">

            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom-wrap">

                        <?php if ( $settings['show_copyright'] == 'yes' ) : ?>
                            <p class="text-nocopy text-white">
                            <?php echo wp_kses_post( $settings['copyright'] ); ?>
                            </p>
                        <?php endif; ?>

                        <?php if ( $settings['show_currency'] == 'yes' ) : ?>
                            <?php 
                            if ( class_exists('woocs') ) {
                                global $WOOCS;

                                if ( ! isset( $WOOCS ) ) {
                                    return;
                                }
                                $currencies = $WOOCS->get_currencies();
                                ?>

                                <div class="tf-currencies">
                                    <select id="custom-currency-switcher" class="tf-dropdown-select style-default type-currencies color-white">
                                        <?php foreach ( $currencies as $code => $currency ): ?>
                                            <?php
                                                $flag_url = $currency['flag'];
                                            ?>
                                            <option 
                                                value="<?php echo esc_attr($code); ?>" 
                                                data-thumbnail="<?php echo esc_url($flag_url); ?>" 
                                                <?php echo esc_attr(($WOOCS->current_currency === $code) ? 'selected' : ''); ?>
                                            >
                                                <?php echo esc_html($currency['description']) . ' (' . esc_html($code) . ' ' . esc_html($currency['symbol']) . ')'; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php } else { ?>
                                <div class="tf-currencies">
                                    <select class="tf-dropdown-select style-default type-currencies color-white">
                                        <option value="USD" selected>United States (USD $)
                                        </option>
                                        <option value="EUR">France (EUR €)</option>
                                        <option value="EUR">Germany (EUR €)</option>
                                        <option value="VND">Vietnam (VND ₫)</option>
                                    </select>
                                </div>
                            <?php } ?>
                        <?php endif; ?>
                        
                        <?php if ( $settings['show_payment'] == 'yes' ) : ?>

                            <?php $theme = wp_get_theme();
                            if ( 'Vemus' == $theme->name || 'Vemus' == $theme->parent_theme ) { ?>
                                <ul class="paymend-method-list">
                                    <?php
                                    $img_payment = explode(',', themesflat_get_opt('img_payment')); 
                                    if (!empty($img_payment[0])) {
                                        foreach ($img_payment as $image) {
                                            echo '<li><img src="'.esc_attr($image).'" alt="'.esc_html__("payment",'vemus').'"></</li>';
                                        }
                                    }                                
                                    ?>
                                </ul>
                            <?php } ?>

                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

    <?php
    }


}