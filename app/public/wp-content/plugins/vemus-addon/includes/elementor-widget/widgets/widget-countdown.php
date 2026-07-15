<?php
/**
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Vemus_CountDown extends \Elementor\Widget_Base {

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
		return 'vemus_countdown';
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
		return esc_html__( 'Vemus CountDown', 'vemus-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve vemus countdown widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-countdown';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the vemus Slider widget belongs to.
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
	 * Retrieve the list of keywords the vemus Slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords()
	{
		return ['countdown' , 'tf'];
	}

    public function get_script_depends() {
		return [ 'js-countdown','slider-core' ];
	}

	/**
	 * Register vemus Slider widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		// Start List Setting        
			$this->start_controls_section( 'section_setting',
	            [
	                'label' => esc_html__('vemus Count Down', 'vemus-addon'),
	            ]
	        );

			$this->add_control(
                'style',
                [
                    'label' => esc_html__('Style', 'vemus-addon'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'style1',
                    'options'     => [
                        'style1' => esc_html__( 'Style 1', 'vemus-addon' ),
                        'style2' => esc_html__( 'Style 2', 'vemus-addon' ),
                    ],
                ]
            );

            $this->add_control(
                'set_date',
                [
                    'label'   => esc_html__( 'Date', 'vemus-addon' ),
                    'type'    => \Elementor\Controls_Manager::DATE_TIME,
                    'default' => date( 'Y/m/d', strtotime( '+5 days' ) ),
                ]
            );

			$this->add_control( 
				'label_countdown',
				[
					'label' => esc_html__( 'Label Date', 'vemus-addon' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Days,Hours,Mins,Secs', 'vemus-addon' ),
				]
			);

			$this->add_responsive_control(
                'align',
                [
                    'label'                => esc_html__( 'Position', 'vemus-addon' ),
                    'type'                 => \Elementor\Controls_Manager::CHOOSE,
                    'label_block'          => false,
                    'options'              => [
                        'left'   => [
                            'title' => esc_html__( 'Left', 'vemus-addon' ),
                            'icon'  => 'eicon-h-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'vemus-addon' ),
                            'icon'  => 'eicon-h-align-center',
                        ],
                        'right'  => [
                            'title' => esc_html__( 'Right', 'vemus-addon' ),
                            'icon'  => 'eicon-h-align-right',
                        ],
                    ],
                    'default'     => 'center',
                    'selectors'            => [
                        '{{WRAPPER}} .wg-countdown' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .wg-countdown .countdown__timer' => 'justify-content: {{VALUE}};',
                    ],
                ]
            );
    

		$this->end_controls_section();

    // Start Style
	$this->start_controls_section( 
        'section_number',
        [
        	'label' => esc_html__( 'Style', 'vemus-addon' ),
        	'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
	); 

	$this->add_responsive_control(
		'content_gap',
		[
			'label'     => esc_html__( 'Gap', 'vemus-addon' ),
			'type'      => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px','%','vh' ],
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 150,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wg-countdown .countdown__timer' => 'column-gap: {{SIZE}}{{UNIT}};',
			],
			'condition' => [
				'style'	=> 'style1',
			],
		]
	);

	$this->add_responsive_control(
		'content_width',
		[
			'label'     => esc_html__( 'Width', 'vemus-addon' ),
			'type'      => \Elementor\Controls_Manager::SLIDER,
			'size_units' => [ 'px','%','vh' ],
			'range'     => [
				'px' => [
					'min' => 90,
					'max' => 500,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wg-countdown .countdown__item' => 'width: {{SIZE}}{{UNIT}}; max-width: unset; max-height: unset;',
			],
			'condition' => [
				'style'	=> 'style1',
			],
		]
	);

	$this->add_control(
		'content_background',
		[
			'label' => esc_html__( 'Background', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .wg-countdown .countdown__item, {{WRAPPER}} .wg-countdown-2 ' => 'background: {{VALUE}};',
			],
		]
	);

	$this->add_responsive_control( 
		'content_padding',
		[
			'label' => esc_html__( 'Padding', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			 'allowed_dimensions' => [ 'top', 'bottom' ],
			'selectors' => [
				'{{WRAPPER}} .wg-countdown .countdown__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'style'	=> 'style1',
			],
		]
	);

	$this->add_responsive_control( 
		'content_padding2',
		[
			'label' => esc_html__( 'Padding', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors' => [
				'{{WRAPPER}} .countdown-V04 .countdown__timer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'condition' => [
				'style'	=> 'style2',
			],
		]
	);

	$this->add_control(
		'content_border_radius',
		[
			'label' => esc_html__( 'Border Radius', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors' => [
				'{{WRAPPER}} .wg-countdown .countdown__item, {{WRAPPER}} .wg-countdown-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]
	);

	$this->add_group_control(
		\Elementor\Group_Control_Border::get_type(),
		[
			'name' => 'content_border',
			'label' => esc_html__( 'Border', 'vemus-addon' ),
			'selector' => '{{WRAPPER}} .wg-countdown .countdown__item, {{WRAPPER}} .wg-countdown-2',
		]
	);


	$this->add_control(
		'heading_number',
		[
			'label' => esc_html__( 'Number', 'vemus-addon' ),
			'type' => \Elementor\Controls_Manager::HEADING,					
			'separator' => 'before',
		]
	);	

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'title_typography',
            'selector' => '{{WRAPPER}} .wg-countdown .countdown__value, {{WRAPPER}} .wg-countdown-2 .countdown__value',
        ]
    );

    $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wg-countdown .countdown__value, {{WRAPPER}} .wg-countdown-2 .countdown__value' => 'color: {{VALUE}};',
				],
			]
		);	

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
					'{{WRAPPER}} .wg-countdown .countdown__value, {{WRAPPER}} .wg-countdown-2 .countdown__value' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'heading_label',
			[
				'label' => esc_html__( 'Label', 'vemus-addon' ),
				'type' => \Elementor\Controls_Manager::HEADING,					
				'separator' => 'before',
			]
		);	

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .wg-countdown .countdown__label',
            ]
        );
    
        $this->add_control(
                'description_color',
                [
                    'label' => esc_html__( 'Description Color', 'vemus-addon' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .wg-countdown .countdown__label' => 'color: {{VALUE}};',
                    ],
                ]
            );	
    
	}

	/**
	 * Render vemus Heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	protected function render(): void
	{
		$settings = $this->get_settings_for_display();
        
		$data_time = 0;
		if ( $settings['set_date'] ) {

			$data_time_current  = strtotime( current_time( 'Y/m/d H:i:s' ) );
			$data_time_discount = strtotime( $this->get_settings( 'set_date' ) );

			if ( $data_time_discount > $data_time_current ) {
				$data_time = $data_time_discount - $data_time_current;
			}
		}
        ?>
				<?php if($settings['style'] == 'style1'): ?>

                    <div class="wg-countdown">
                        <div class="countdown-V03">
                            <div class="js-countdown-core" data-timer="<?php echo esc_attr($data_time); ?>" data-labels="<?php echo esc_attr($settings['label_countdown']); ?>"></div>
                        </div>
                    </div>

				<?php else: ?>

                <div class="wg-countdown">
                    <div class="countdown-V04 wow fadeInUp">
                        <div class="js-countdown-core cd-custom" data-timer="<?php echo esc_attr($data_time); ?>" data-labels="<?php echo esc_attr($settings['label_countdown']); ?>"></div>
                    </div>
                </div>

				<?php endif; ?>

		
    <?php  }

}