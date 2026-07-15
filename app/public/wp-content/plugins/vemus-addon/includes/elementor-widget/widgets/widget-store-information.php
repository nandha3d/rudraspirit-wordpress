<?php

class Vemus_Store_Information extends \Elementor\Widget_Base {

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
		return 'vemus_store_information';
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
		return esc_html__( 'Vemus Store Information', 'vemus-addon' );
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
		return 'eicon-kit-parts';
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
		return ['animation' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
        protected function register_controls() {
            
        $this->start_controls_section(
            'section_store_list',
            [
                'label' => esc_html__('Store List', 'vemus-addon'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'store_title',
            [
                'label' => esc_html__('Store Name', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Vemus Sydney',
            ]
        );

        $repeater->add_control(
            'caption_address',
            [
                'label' => esc_html__('Caption - Address', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Address:',
            ]
        );

        $repeater->add_control(
            'store_address',
            [
                'label' => esc_html__('Address', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '15 George st, Sydney, NSW 2000, Australia',
            ]
        );

        $repeater->add_control(
            'caption_email',
            [
                'label' => esc_html__('Caption - Email', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Email:',
            ]
        );


        $repeater->add_control(
            'store_email',
            [
                'label' => esc_html__('Email', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'store@vemus.com',
            ]
        );

        
        $repeater->add_control(
            'caption_phone',
            [
                'label' => esc_html__('Caption - Phone', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Phone:',
            ]
        );

        $repeater->add_control(
            'store_phone',
            [
                'label' => esc_html__('Phone', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '+64 3452 8540',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Get Direction',
            ]
        );

        $repeater->add_control(
            'store_map_link',
            [
                'label' => esc_html__('Google Map Link', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => 'https://www.google.com/maps',
                    'is_external' => true,
                ],
            ]
        );

        $repeater->add_control(
            'store_image',
            [
                'label' => esc_html__('Store Image', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'store_list',
            [
                'label' => esc_html__('Stores', 'vemus-addon'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
						[
							'store_title' => esc_html__( 'Vemus Sydney', 'vemus-addon' ),
							'caption_address' => esc_html__( 'Address:', 'vemus-addon' ),
							'store_address' => esc_html__( '15 George st, Sydney, NSW 2000, Australia', 'vemus-addon' ),
							'caption_email' => esc_html__( 'Email', 'vemus-addon' ),
							'store_email' => esc_html__( 'store@vemus.com', 'vemus-addon' ),
							'caption_phone' => esc_html__( 'Phone:', 'vemus-addon' ),
							'store_phone' => esc_html__( '+64 3452 8540', 'vemus-addon' ),
							'button_text' => esc_html__( 'Get Direction', 'vemus-addon' ),
							'store_map_link' => esc_html__( '#', 'vemus-addon' ),
						],
                        						[
							'store_title' => esc_html__( 'Vemus Sydney', 'vemus-addon' ),
							'caption_address' => esc_html__( 'Address:', 'vemus-addon' ),
							'store_address' => esc_html__( '15 George st, Sydney, NSW 2000, Australia', 'vemus-addon' ),
							'caption_email' => esc_html__( 'Email', 'vemus-addon' ),
							'store_email' => esc_html__( 'store@vemus.com', 'vemus-addon' ),
							'caption_phone' => esc_html__( 'Phone:', 'vemus-addon' ),
							'store_phone' => esc_html__( '+64 3452 8540', 'vemus-addon' ),
							'button_text' => esc_html__( 'Get Direction', 'vemus-addon' ),
							'store_map_link' => esc_html__( '#', 'vemus-addon' ),
						],
                        						[
							'store_title' => esc_html__( 'Vemus Sydney', 'vemus-addon' ),
							'caption_address' => esc_html__( 'Address:', 'vemus-addon' ),
							'store_address' => esc_html__( '15 George st, Sydney, NSW 2000, Australia', 'vemus-addon' ),
							'caption_email' => esc_html__( 'Email', 'vemus-addon' ),
							'store_email' => esc_html__( 'store@vemus.com', 'vemus-addon' ),
							'caption_phone' => esc_html__( 'Phone:', 'vemus-addon' ),
							'store_phone' => esc_html__( '+64 3452 8540', 'vemus-addon' ),
							'button_text' => esc_html__( 'Get Direction', 'vemus-addon' ),
							'store_map_link' => esc_html__( '#', 'vemus-addon' ),
						],
					],
                'title_field' => '{{{ store_title }}}',
            ]
        );

        $this->end_controls_section();


            // Section: Style Accordion Title
            $this->start_controls_section(
                'style_accordion_title',
                [
                    'label' => esc_html__('Accordion Title', 'vemus-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'accordion_title_typo',
                    'selector' => '{{WRAPPER}} .accordion-title span',
                ]
            );

            $this->add_control(
                'accordion_title_color',
                [
                    'label' => esc_html__('Text Color', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .accordion-title span' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'accordion_title_bg',
                [
                    'label' => esc_html__('Background', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .accordion-title' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_section();

            // Section: Style Info List
            $this->start_controls_section(
                'style_info_list',
                [
                    'label' => esc_html__('Info List', 'vemus-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'caption_typo',
                    'selector' => '{{WRAPPER}} .store-info-list .caption',
                ]
            );

            $this->add_control(
                'caption_color',
                [
                    'label' => esc_html__('Caption Color', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .store-info-list .caption' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_control(
                'link_color',
                [
                    'label' => esc_html__('Link Color', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .store-info-list .link' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->end_controls_section();


            // Section: Image Tabs
            $this->start_controls_section(
                'style_img_store',
                [
                    'label' => esc_html__('Image Store', 'vemus-addon'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'img_radius',
                [
                    'label' => esc_html__('Image Border Radius', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => ['min' => 0, 'max' => 100],
                        '%' => ['min' => 0, 'max' => 100],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .img-store img' => 'border-radius: {{SIZE}}{{UNIT}};',
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
    	if ( empty( $settings['store_list'] ) ) {
		return;
	}
    ?>

            <div class="flat-spacing flat-animate-tab-2">
                    <div class="container">
                        <div class="row flex-wrap-reverse">
                            <div class="col-md-6">
                                <div class="store-accordion" id="vemus-address" role="tablist">

                                    <?php foreach ( $settings['store_list'] as $index => $store ) :
                                        $store_id = 'store-' . $index;
                                        $collapse_id = 'collapse-' . $index;
                                        $is_active = $index === 0 ? 'active' : '';
                                        $is_show = $index === 0 ? 'show' : '';
                                    ?>
                                    <div class="widget-accordion-2 nav-tab-item <?php echo esc_attr( $is_active ); ?>" role="presentation" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr( $store_id ); ?>">
                                        <div class="accordion-title <?php echo $index === 0 ? '' : 'collapsed'; ?>" data-bs-target="#<?php echo esc_attr( $collapse_id ); ?>" role="button" data-bs-toggle="collapse"
                                            aria-expanded="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-controls="<?php echo esc_attr( $collapse_id ); ?>">
                                            <span class="h3 fw-normal"><?php echo esc_html( $store['store_title'] ); ?></span>
                                            <span class="icon ic-accordion-custom"></span>
                                        </div>
                                        <div id="<?php echo esc_attr( $collapse_id ); ?>" class="collapse <?php echo esc_attr( $is_show ); ?>" data-bs-parent="#vemus-address">
                                            <ul class="store-info-list">
                                                <?php if ( ! empty( $store['store_address'] ) ) : ?>
                                                <li>
                                                    <p class="caption"><?php echo esc_html( $store['caption_address'] ); ?></p>
                                                    <a href="<?php echo esc_url( $store['store_map_link']['url'] ); ?>" class="link text-main-4" target="_blank">
                                                        <?php echo esc_html( $store['store_address'] ); ?>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $store['store_email'] ) ) : ?>
                                                <li>
                                                    <p class="caption"><?php echo esc_html( $store['caption_email'] ); ?></p>
                                                    <a href="mailto:<?php echo esc_attr( $store['store_email'] ); ?>" class="link text-main-4">
                                                        <?php echo esc_html( $store['store_email'] ); ?>
                                                    </a>
                                                </li>
                                                <?php endif; ?>

                                                <?php if ( ! empty( $store['store_phone'] ) ) : ?>
                                                <li>
                                                    <p class="caption"><?php echo esc_html( $store['caption_phone'] ); ?></p>
                                                    <a href="tel:<?php echo esc_attr( $store['store_phone'] ); ?>" class="link text-main-4">
                                                        <?php echo esc_html( $store['store_phone'] ); ?>
                                                    </a>
                                                </li>
                                                <?php endif; ?>
                                            </ul>

                                            <?php if ( ! empty( $store['store_map_link']['url'] ) ) : ?>
                                            <a href="<?php echo esc_url( $store['store_map_link']['url'] ); ?>" target="_blank" class="btn-get-dir tf-btn-line text-caption-2 fw-normal">
                                                <?php echo esc_html( $store['button_text'] ); ?> <i class="icon icon-arrow-top-right"></i>
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="tab-content mb-md-0 tab-img-store">
                                    <?php foreach ( $settings['store_list'] as $index => $store ) :
                                        $store_id = 'store-' . $index;
                                        $is_active = $index === 0 ? 'active show' : '';
                                    ?>
                                    <div class="img-store tab-pane <?php echo esc_attr( $is_active ); ?>" id="<?php echo esc_attr( $store_id ); ?>" role="tabpanel">
                                        <?php if ( ! empty( $store['store_image']['url'] ) ) : ?>
                                        <img src="<?php echo esc_url( $store['store_image']['url'] ); ?>" alt="Store" class="lazyload">
                                        <?php endif; ?>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            <?php
        }


}