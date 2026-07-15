<?php
/**
 * Elementor Widget: Vemus Rudraksha Mukhi Interactive Showcase
 *
 * @package Vemus_Addon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Vemus_Widget_Rudraksha_Mukhi extends \Elementor\Widget_Base {

    public function __construct( $data = [], $args = null ) {
        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'vemus_rudraksha_mukhi';
    }

    public function get_title() {
        return esc_html__( 'Vemus Rudraksha Mukhi Showcase', 'vemus-addon' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'vemus_addons_core' ];
    }

    public function get_keywords() {
        return [ 'rudraksha', 'mukhi', 'shiva', 'tabs', 'interactive', 'vemus' ];
    }

    protected function register_controls() {
        $this->start_controls_section( 'section_setting', [
            'label' => esc_html__( 'Rudraksha Mukhi Settings', 'vemus-addon' ),
        ] );

        $this->add_control( 'mukhi_number', [
            'label'       => esc_html__( 'Select Mukhi Number (0 = Auto Detect from Page ID)', 'vemus-addon' ),
            'type'        => \Elementor\Controls_Manager::SELECT,
            'default'     => '0',
            'options'     => [
                '0'  => esc_html__( 'Auto Detect from Page ID / Post Title', 'vemus-addon' ),
                '1'  => esc_html__( '1 Mukhi (Ek Mukhi)', 'vemus-addon' ),
                '2'  => esc_html__( '2 Mukhi (Do Mukhi)', 'vemus-addon' ),
                '3'  => esc_html__( '3 Mukhi (Teen Mukhi)', 'vemus-addon' ),
                '4'  => esc_html__( '4 Mukhi (Chaar Mukhi)', 'vemus-addon' ),
                '5'  => esc_html__( '5 Mukhi (Panch Mukhi)', 'vemus-addon' ),
                '6'  => esc_html__( '6 Mukhi (Cheh Mukhi)', 'vemus-addon' ),
                '7'  => esc_html__( '7 Mukhi (Saat Mukhi)', 'vemus-addon' ),
                '8'  => esc_html__( '8 Mukhi (Aath Mukhi)', 'vemus-addon' ),
                '9'  => esc_html__( '9 Mukhi (Nau Mukhi)', 'vemus-addon' ),
                '10' => esc_html__( '10 Mukhi (Das Mukhi)', 'vemus-addon' ),
                '11' => esc_html__( '11 Mukhi (Gyarah Mukhi)', 'vemus-addon' ),
                '12' => esc_html__( '12 Mukhi (Barah Mukhi)', 'vemus-addon' ),
                '13' => esc_html__( '13 Mukhi (Terah Mukhi)', 'vemus-addon' ),
                '14' => esc_html__( '14 Mukhi (Chaudah Mukhi - Deva Mani)', 'vemus-addon' ),
            ],
        ] );

        $this->add_control( 'show_top_card', [
            'label'        => esc_html__( 'Show Top Product Card Header', 'vemus-addon' ),
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Show', 'vemus-addon' ),
            'label_off'    => esc_html__( 'Hide', 'vemus-addon' ),
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'initial_tab', [
            'label'   => esc_html__( 'Initial Active Tab', 'vemus-addon' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'overview',
            'options' => [
                'overview' => esc_html__( 'Overview & Lore', 'vemus-addon' ),
                'benefits' => esc_html__( 'Divine Benefits Grid', 'vemus-addon' ),
                'ritual'   => esc_html__( 'Wearing Ritual Timeline', 'vemus-addon' ),
                'mantra'   => esc_html__( '108 Japa Counter & Mantra', 'vemus-addon' ),
            ],
        ] );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $mukhi    = intval( $settings['mukhi_number'] );
        $top_card = ! empty( $settings['show_top_card'] ) ? $settings['show_top_card'] : 'yes';
        $tab      = ! empty( $settings['initial_tab'] ) ? $settings['initial_tab'] : 'overview';

        if ( function_exists( 'vemus_rudraksha_mukhi_shortcode' ) ) {
            echo vemus_rudraksha_mukhi_shortcode( array(
                'mukhi'         => $mukhi,
                'show_top_card' => $top_card,
                'initial_tab'   => $tab,
            ) );
        } else {
            echo '<div class="vemus-rudraksha-error">Please ensure the Vemus Child theme functions and shortcodes are active.</div>';
        }
    }
}
