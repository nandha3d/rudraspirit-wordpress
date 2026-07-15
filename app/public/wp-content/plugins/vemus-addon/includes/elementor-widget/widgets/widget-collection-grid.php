<?php

class Vemus_Collection_Grid extends \Elementor\Widget_Base {

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
		return 'vemus_collection_grid';
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
		return esc_html__( 'Vemus Collection Grid', 'vemus-addon' );
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
		return 'eicon-gallery-grid';
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
		return ['collection' , 'tf'];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
        $this->start_controls_section( 'section_collection_group1', [
            'label' => esc_html__( 'Collections - Group 1 (item_1)', 'vemus-addon' ),
        ] );

        $repeater1 = new \Elementor\Repeater();

        $repeater1->add_control( 'collection_image', [
            'label' => esc_html__( 'Image', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ] );

        $repeater1->add_control( 'collection_title', [
            'label' => esc_html__( 'Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'UNDER $100', 'vemus-addon' ),
        ] );

        $repeater1->add_control( 'collection_link', [
            'label' => esc_html__( 'Link', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'vemus-addon' ),
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
        ] );

        $this->add_control( 'collections_item_1', [
            'label' => esc_html__( 'Items for item_1', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater1->get_controls(),
            'default' => [
				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
                				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
                				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
			],
            'title_field' => '{{{ collection_title }}}',
        ] );

        $this->end_controls_section();

        // Collection Group 2 (item_2)
        $this->start_controls_section( 'section_collection_group2', [
            'label' => esc_html__( 'Collections - Group 2 (item_2)', 'vemus-addon' ),
        ] );

        $repeater2 = new \Elementor\Repeater();

        $repeater2->add_control( 'collection_image', [
            'label' => esc_html__( 'Image', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ] );

        $repeater2->add_control( 'collection_title', [
            'label' => esc_html__( 'Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'UNDER $63', 'vemus-addon' ),
        ] );

        $repeater2->add_control( 'collection_link', [
            'label' => esc_html__( 'Link', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::URL,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
        ] );

        $this->add_control( 'collections_item_2', [
            'label' => esc_html__( 'Items for item_2', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater2->get_controls(),
            'default' => [
				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
                				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
                				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
			],
            'title_field' => '{{{ collection_title }}}',
        ] );

        $this->end_controls_section();

        // Collection Group 3 (item_3)
        $this->start_controls_section( 'section_collection_group3', [
            'label' => esc_html__( 'Collections - Group 3 (item_3)', 'vemus-addon' ),
        ] );

        $repeater3 = new \Elementor\Repeater();

        $repeater3->add_control( 'collection_image', [
            'label' => esc_html__( 'Image', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ] );

        $repeater3->add_control( 'collection_title', [
            'label' => esc_html__( 'Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => esc_html__( 'UNDER $79', 'vemus-addon' ),
        ] );

        $repeater3->add_control( 'collection_link', [
            'label' => esc_html__( 'Link', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::URL,
            'default' => [
                'url' => '#',
                'is_external' => false,
                'nofollow' => false,
            ],
        ] );

        $this->add_control( 'collections_item_3', [
            'label' => esc_html__( 'Items for item_3', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater3->get_controls(),
            'default' => [
				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
                				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
                				[
					'collection_title' => esc_html__( 'UNDER $100', 'vemus-addon' ),
                    'collection_link' => esc_html__( '#', 'vemus-addon' ),
				],
			],
            'title_field' => '{{{ collection_title }}}',
        ] );

        $this->end_controls_section();

        // === STYLE OPTIONS ===
        $this->start_controls_section( 'section_style_general', [
            'label' => esc_html__( 'General Style', 'vemus-addon' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'category_background_color', [
            'label'     => esc_html__( 'Background', 'vemus-addon' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-category .btn-view' => 'background-color: {{VALUE}} !important;',
            ],
        ] );

        $this->add_responsive_control( 'category_padding', [
            'label'      => esc_html__( 'Category Padding', 'vemus-addon' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}}     .wg-category .btn-view' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'section_style_title', [
            'label' => esc_html__( 'Title Style', 'vemus-addon' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name'     => 'title_typography',
            'label'    => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .wg-category .btn-view',
        ] );

        $this->add_control( 'title_color', [
            'label'     => esc_html__( 'Color', 'vemus-addon' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-category .btn-view' => 'color: {{VALUE}} !important;',
            ],
        ] );

        $this->add_control( 'title_color_hover', [
            'label'     => esc_html__( 'Hover Color', 'vemus-addon' ),
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wg-category .btn-view:hover' => 'color: {{VALUE}} !important;',
            ],
        ] );

        $this->end_controls_section();

        $this->start_controls_section( 'section_style_image', [
            'label' => esc_html__( 'Image Style', 'vemus-addon' ),
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ] );

        $this->add_responsive_control( 'image_radius', [
            'label'      => esc_html__( 'Border Radius', 'vemus-addon' ),
            'type'       => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors'  => [
                '{{WRAPPER}} .wg-category .image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
            ],
        ] );

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

    $group1 = !empty( $settings['collections_item_1'] ) ? $settings['collections_item_1'] : [];
    $group2 = !empty( $settings['collections_item_2'] ) ? $settings['collections_item_2'] : [];
    $group3 = !empty( $settings['collections_item_3'] ) ? $settings['collections_item_3'] : [];

    ?>
  
            <div class="tf-grid-layout sm-col-2 xl-col-3 category-grid wow fadeInUp">

                <div class="item_1">
                    <?php foreach ( $group1 as $item ) :
                        $link = isset($item['collection_link']) ? $item['collection_link'] : [];
                        $url = !empty($link['url']) ? $link['url'] : '#';
                        $target = !empty($link['is_external']) ? ' target="_blank"' : '';
                        $rel_values = [];
                        if ( !empty($link['is_external']) ) $rel_values[] = 'noopener';
                        if ( !empty($link['nofollow']) ) $rel_values[] = 'nofollow';
                        $rel = !empty($rel_values) ? ' rel="'.esc_attr( implode(' ', $rel_values) ).'"' : '';
                        $img = !empty($item['collection_image']['url']) ? $item['collection_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
                    ?>
                        <a href="<?php echo esc_url( $url ); ?>"<?php echo $target . $rel; ?> class="wg-category hover-img4">
                            <div class="image img-style4">
                                <img src="<?php echo esc_url( $img ); ?>" data-src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $item['collection_title'] ); ?>" class="lazyload">
                            </div>
                            <h3 class="btn-view link">
                                <?php echo esc_html( $item['collection_title'] ); ?>
                                <i class="icon icon-arrow-top-right"></i>
                            </h3>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="item_2">
                    <?php foreach ( $group2 as $item ) :
                        $link = isset($item['collection_link']) ? $item['collection_link'] : [];
                        $url = !empty($link['url']) ? $link['url'] : '#';
                        $target = !empty($link['is_external']) ? ' target="_blank"' : '';
                        $rel_values = [];
                        if ( !empty($link['is_external']) ) $rel_values[] = 'noopener';
                        if ( !empty($link['nofollow']) ) $rel_values[] = 'nofollow';
                        $rel = !empty($rel_values) ? ' rel="'.esc_attr( implode(' ', $rel_values) ).'"' : '';
                        $img = !empty($item['collection_image']['url']) ? $item['collection_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
                    ?>
                        <a href="<?php echo esc_url( $url ); ?>"<?php echo $target . $rel; ?> class="wg-category hover-img4">
                            <div class="image img-style4">
                                <img src="<?php echo esc_url( $img ); ?>" data-src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $item['collection_title'] ); ?>" class="lazyload">
                            </div>
                            <h3 class="btn-view link">
                                <?php echo esc_html( $item['collection_title'] ); ?>
                                <i class="icon icon-arrow-top-right"></i>
                            </h3>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="item_3">
                    <?php foreach ( $group3 as $item ) :
                        $link = isset($item['collection_link']) ? $item['collection_link'] : [];
                        $url = !empty($link['url']) ? $link['url'] : '#';
                        $target = !empty($link['is_external']) ? ' target="_blank"' : '';
                        $rel_values = [];
                        if ( !empty($link['is_external']) ) $rel_values[] = 'noopener';
                        if ( !empty($link['nofollow']) ) $rel_values[] = 'nofollow';
                        $rel = !empty($rel_values) ? ' rel="'.esc_attr( implode(' ', $rel_values) ).'"' : '';
                        $img = !empty($item['collection_image']['url']) ? $item['collection_image']['url'] : \Elementor\Utils::get_placeholder_image_src();
                    ?>
                        <a href="<?php echo esc_url( $url ); ?>"<?php echo $target . $rel; ?> class="wg-category hover-img4">
                            <div class="image img-style4">
                                <img src="<?php echo esc_url( $img ); ?>" data-src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $item['collection_title'] ); ?>" class="lazyload">
                            </div>
                            <h3 class="btn-view link">
                                <?php echo esc_html( $item['collection_title'] ); ?>
                                <i class="icon icon-arrow-top-right"></i>
                            </h3>
                        </a>
                    <?php endforeach; ?>
                </div>

            </div>

    <?php
}
}