<?php

class Vemus_About_Information extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	public function get_name() {
		return 'vemus_about';
	}

	public function get_title() {
		return esc_html__('Vemus About Us Information', 'vemus-addon');
	}

	public function get_icon() {
		return 'eicon-posts-group';
	}

	public function get_categories() {
		return ['vemus_addons_core'];
	}

	public function get_keywords() {
		return ['about', 'tf'];
	}

	protected function register_controls() {
		$this->start_controls_section('section_setting', [
			'label' => esc_html__('Vemus About Us Information', 'vemus-addon'),
		]);

		// Image
		$this->add_control('main_image', [
			'label' => esc_html__('Main Image', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/about-1.jpg",
            ],
		]);

		$this->add_control('box_image', [
			'label' => esc_html__('Box Image', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/about-2.png",
            ],
		]);

		// Subtitle
		$this->add_control('subtitle', [
			'label' => esc_html__('Subtitle', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => 'we are vemus',
		]);

		// Title
		$this->add_control('title', [
			'label' => esc_html__('Title', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'default' => 'Every piece of jewelry should feel as special as the moment it represents.',
		]);

		// Description
		$this->add_control('description', [
			'label' => esc_html__('Description', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXTAREA,
			'default' => 'From the delicate curves of a handcrafted ring to the brilliance of a perfectly cut diamond...',
		]);

		// Author Image
		$this->add_control('author_image', [
			'label' => esc_html__('Author Image', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/about-4.jpg",
            ],
		]);

		// Author Name
		$this->add_control('author_name', [
			'label' => esc_html__('Author Name', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => 'John Smith',
		]);

		// Author Duty
		$this->add_control('author_duty', [
			'label' => esc_html__('Author Duty', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::TEXT,
			'default' => 'Founder of Vemus',
		]);

		// Signature Image
		$this->add_control('signature', [
			'label' => esc_html__('Signature Image', 'vemus-addon'),
			'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
                'url' => TF_PLUGIN_URL."includes/elementor-widget/assets/images/about-3.png",
            ],
		]);

		$this->end_controls_section();

        $this->start_controls_section( 'section_style', [
            'label' => esc_html__( 'Style', 'vemus-addon' ),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ] );

                $this->add_control( 'sub_title_heading', [
            'label' => esc_html__( 'Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'sub_title_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-about .brand-intro_subtitle',
        ] );

        $this->add_control( 'sub_title_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-about .brand-intro_subtitle' => 'color: {{VALUE}} !important',
            ],
        ] );

		$this->add_responsive_control(
			'sub_title_margin',
			[
				'label'     => esc_html__( 'Spacing', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .widget-about .brand-intro_subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control( 'title_heading', [
            'label' => esc_html__( 'Title', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'title_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-about .brand-intro_title',
        ] );

        $this->add_control( 'title_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-about .brand-intro_title' => 'color: {{VALUE}} !important',
            ],
        ] );

		$this->add_responsive_control(
			'title_margin',
			[
				'label'     => esc_html__( 'Spacing', 'vemus-addon' ),
				'type'      => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px','%','vh' ],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}}  .widget-about .brand-intro_title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $this->add_control( 'desc_heading', [
            'label' => esc_html__( 'Description', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( \Elementor\Group_Control_Typography::get_type(), [
            'name' => 'desc_typography',
            'label' => esc_html__( 'Typography', 'vemus-addon' ),
            'selector' => '{{WRAPPER}} .widget-about .brand-intro_text',
        ] );

        $this->add_control( 'desc_color', [
            'label' => esc_html__( 'Color', 'vemus-addon' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .widget-about .brand-intro_text' => 'color: {{VALUE}} !important',
            ],
        ] );
        
        $this->end_controls_section();
	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		?>
<section class="s-brand-intro flat-spacing-6 pb-0 widget-about">
	<div class="container">
		<div class="row d-flex align-items-center">

			<?php if ( !empty($settings['main_image']['url']) ) : ?>
				<div class="col-md-6">
					<div class="brand-intro_image mb-md-0">
						<img src="<?php echo esc_url($settings['main_image']['url']); ?>" alt="main-image" class="lazyload intro-photo">

						<?php if ( !empty($settings['box_image']['url']) ) : ?>
							<div class="brand-box">
								<img src="<?php echo esc_url($settings['box_image']['url']); ?>" alt="box-image" class="lazyload">
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="col-md-6">
				<?php if ( !empty($settings['subtitle']) ) : ?>
					<h6 class="brand-intro_subtitle"><?php echo esc_html($settings['subtitle']); ?></h6>
				<?php endif; ?>

				<?php if ( !empty($settings['title']) ) : ?>
					<h2 class="brand-intro_title"><?php echo esc_html($settings['title']); ?></h2>
				<?php endif; ?>

				<?php if ( !empty($settings['description']) ) : ?>
					<p class="brand-intro_text"><?php echo esc_html($settings['description']); ?></p>
				<?php endif; ?>

				<span class="br-line"></span>

				<?php if ( !empty($settings['author_name']) || !empty($settings['author_image']['url']) || !empty($settings['signature']['url']) ) : ?>
					<div class="brand-intro_author flex-sm-nowrap">
						<?php if ( !empty($settings['author_image']['url']) || !empty($settings['author_name']) ) : ?>
							<div class="author-info">
								<?php if ( !empty($settings['author_image']['url']) ) : ?>
									<img src="<?php echo esc_url($settings['author_image']['url']); ?>" alt="Author" class="img-author">
								<?php endif; ?>
								<div class="info">
									<?php if ( !empty($settings['author_name']) ) : ?>
										<h5 class="name"><a href="#" class="link"><?php echo esc_html($settings['author_name']); ?></a></h5>
									<?php endif; ?>
									<?php if ( !empty($settings['author_duty']) ) : ?>
										<span class="duty text-main-4"><?php echo esc_html($settings['author_duty']); ?></span>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( !empty($settings['signature']['url']) ) : ?>
							<div class="author-signature">
								<img src="<?php echo esc_url($settings['signature']['url']); ?>" alt="Signature">
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>

		<?php
	}
}
