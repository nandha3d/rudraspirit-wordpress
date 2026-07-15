<?php

class Vemus_Mega_Menu extends \Elementor\Widget_Base {

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
		return 'vemus_mega_menu';
	}

	/**
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Vemus Mega Menu', 'vemus-addon' );
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
		return 'eicon-mega-menu';
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
		return ['menu' , 'tf'];
	}

	public function get_style_depends() {
		return [ 'vemus-addons' ];
	}

	/**
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('Vemus Mega Menu', 'vemus-addon'),
	            ]
	        );

			$repeater = new \Elementor\Repeater();

            $repeater->add_control(
                'image',
                [
                    'label' => esc_html__('Image Home Page', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

            $repeater->add_control(
                'title',
                [
                    'label' => esc_html__('Title', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'HOMEPAGE 1',
                    'label_block' => true,
                ]
            );

			$repeater->add_control(
                'badge',
                [
                    'label' => esc_html__('Badge', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => 'Hot',
                    'label_block' => true,
                ]
            );

			$repeater->add_control(
				'badge_background',
				[
					'label' => __( 'Badge Background', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}}_content .demo-label' => 'background-color: {{VALUE}} !important;',
					],
				]
			);

            $repeater->add_control(
                'link',
                [
                    'label' => esc_html__('Link', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => 'https://your-link.com',
                    'default' => [
                        'url' => '#',
                    ],
                ]
            );

            $this->add_control(
                'collections',
                [
                    'label' => esc_html__('Collection Items', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
					'default' => [
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'HOMEPAGE 1', 'vemus-addon' ),
						],
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'HOMEPAGE 2', 'vemus-addon' ),
						],
						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'HOMEPAGE 3', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'HOMEPAGE 4', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'HOMEPAGE 5', 'vemus-addon' ),
						],
                        						[
							'image' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/placeholder-image.jpg",
							'title' => esc_html__( 'HOMEPAGE 6', 'vemus-addon' ),
						],
	
					],
                    'title_field' => '{{{ title }}}',
                ]
            );

			$this->add_control(
                'title_coming',
                [
                    'label' => esc_html__('Title Coming Soon', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'default' => 'MORE ARE <span class="text-primary">COMING</span> SOON...',
                    'label_block' => true,
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

		<div class="widget-mega-menu">
			<div class="mega-home start-0">
				<?php if ( !empty( $settings['collections'] ) && is_array( $settings['collections'] ) ) : ?>
					<ul class="row-demo">
						<?php foreach ( $settings['collections'] as $index => $item ) :
							$image_url = !empty( $item['image']['url'] ) ? esc_url( $item['image']['url'] ) : '';
							$title     = !empty( $item['title'] ) ? wp_kses_post( $item['title'] ) : '';
							$badge     = !empty( $item['badge'] ) ? wp_kses_post( $item['badge'] ) : '';
							$link_url  = !empty( $item['link']['url'] ) ? esc_url( $item['link']['url'] ) : '#';
							$link_target = ! empty( $settings['link']['is_external'] ) ? ' target="_blank"' : '';
						?>
							<li class="demo-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ?? '' ); ?>_content">
								<a href="<?php echo $link_url; ?>" <?php echo $link_target; ?>>
									<?php if ( $image_url ) : ?>
										<div class="demo-image relative">
											<img src="<?php echo $image_url; ?>" alt="image">
										</div>
									<?php endif; ?>
									<?php if ( $title || $badge ) : ?>
										<p class="demo-name">
											<?php echo $title; ?>
											<?php if ( $badge ) : ?>
												<span class="demo-label"><?php echo $badge; ?></span>
											<?php endif; ?>
										</p>
									<?php endif; ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
	
				<?php if ( !empty( $settings['title_coming'] ) ) : ?>
					<p class="font-2 text-coming">
						<?php echo wp_kses_post( $settings['title_coming'] ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>



            <?php
        }


}