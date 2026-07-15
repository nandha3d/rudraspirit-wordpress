<?php 
$wp_customize->add_setting( 
  'show_announcement_mobile',
    array(
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
        'default' => themesflat_customize_default('show_announcement_mobile'),     
    )   
);
$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'show_announcement_mobile',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Show Announcement Bar Mobile', 'vemus'),
        'section' => 'section_mobile_announcement',
        'priority' => 1,
    ))
); 