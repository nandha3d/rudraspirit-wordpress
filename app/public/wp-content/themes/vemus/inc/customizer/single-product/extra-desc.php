<?php

$wp_customize->add_setting(
    'tf_extra_desc_title',
    array(
        'default'   => themesflat_customize_default('tf_extra_desc_title'),
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_setting( 
    'tf_trust_seal',
    array(
        'default' => themesflat_customize_default('tf_trust_seal'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_share',
    array(
        'default' => themesflat_customize_default('tf_product_share'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_share_facebook',
    array(
        'default' => themesflat_customize_default('tf_product_share_facebook'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_share_instagram',
    array(
        'default' => themesflat_customize_default('tf_product_share_instagram'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_share_x',
    array(
        'default' => themesflat_customize_default('tf_product_share_x'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_share_snapchat',
    array(
        'default' => themesflat_customize_default('tf_product_share_snapchat'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_product_share_linkin',
    array(
        'default' => themesflat_customize_default('tf_product_share_linkin'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_delivery_info',
    array(
        'default' => themesflat_customize_default('tf_delivery_info'),
        'sanitize_callback' => 'themesflat_sanitize_checkbox',
    )   
);

$wp_customize->add_setting( 
    'tf_trust_seal_text',
    array(
        'default' => themesflat_customize_default('tf_trust_seal_text'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_trust_seal_items',
    array(
        'default' => themesflat_customize_default('tf_trust_seal_items'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_text',
    array(
        'default' => themesflat_customize_default('tf_delivery_text'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_icon',
    array(
        'default' => themesflat_customize_default('tf_delivery_icon'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_text2',
    array(
        'default' => themesflat_customize_default('tf_delivery_text2'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_icon2',
    array(
        'default' => themesflat_customize_default('tf_delivery_icon2'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_text3',
    array(
        'default' => themesflat_customize_default('tf_delivery_text3'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_icon3',
    array(
        'default' => themesflat_customize_default('tf_delivery_icon3'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_text4',
    array(
        'default' => themesflat_customize_default('tf_delivery_text4'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_setting(
    'tf_delivery_icon4',
    array(
        'default' => themesflat_customize_default('tf_delivery_icon4'),
        'sanitize_callback' => 'esc_attr',
    )   
);

$wp_customize->add_control( new themesflat_Info( $wp_customize,
    'tf_extra_desc_title',
    array(
        'label' => esc_html__('Extra description', 'vemus'),
        'section' => 'section_extra_desc',
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_trust_seal',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Trust Seal ( OFF | ON )', 'vemus'),
        'section' => 'section_extra_desc',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_trust_seal_text',
    array(
        'label' => esc_html__('Trust seal text', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_trust_seal' )
    ) )
);

$wp_customize->add_control( new TF_Multiple_Images( $wp_customize,
    'tf_trust_seal_items',
    array(
        'label'       => esc_html__('Trust seal items', 'vemus'),
        'type'        => 'text',
        'section'     => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on('tf_trust_seal'),
    )
) );

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_product_share',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Product share ( OFF | ON )', 'vemus'),
        'section' => 'section_extra_desc',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_share_facebook',
    array(
        'label' => esc_html__('Facebook', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_share' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_share_instagram',
    array(
        'label' => esc_html__('Instagram', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_share' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_share_x',
    array(
        'label' => esc_html__('X', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_share' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_share_snapchat',
    array(
        'label' => esc_html__('Snapchat', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_share' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_product_share_linkin',
    array(
        'label' => esc_html__('Linkedin', 'vemus'),
        'type' => 'checkbox',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_product_share' )
    ) )
);

$wp_customize->add_control( new themesflat_Checkbox( $wp_customize,
    'tf_delivery_info',
    array(
        'type' => 'checkbox',
        'label' => esc_html__('Delivery Info ( OFF | ON )', 'vemus'),
        'section' => 'section_extra_desc',
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_text',
    array(
        'label' => esc_html__('Delivery text', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_icon',
    array(
        'label' => esc_html__('Delivery icon', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_text2',
    array(
        'label' => esc_html__('Delivery text 2', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_icon2',
    array(
        'label' => esc_html__('Delivery icon 2', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_text3',
    array(
        'label' => esc_html__('Delivery text 3', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_icon3',
    array(
        'label' => esc_html__('Delivery icon 3', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_text4',
    array(
        'label' => esc_html__('Delivery text 4', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

$wp_customize->add_control( new WP_Customize_Control( $wp_customize,
    'tf_delivery_icon4',
    array(
        'label' => esc_html__('Delivery icon 4', 'vemus'),
        'type' => 'text',
        'section' => 'section_extra_desc',
        'active_callback' => fn() => check_setting_is_on( 'tf_delivery_info' )
    ) )
);

class TF_Multiple_Images extends WP_Customize_Control { 
    public $type = 'tf_multiple_images';
    public function render_content() {
    ?>
        <div class="tf-multiple-images">
            <div><?php parent::render_content(); ?></div>
            <button class="button tf-btn"><?php _e('Choose images','vemus'); ?></button>
            <div class="selected-images-preview">
            <?php
                $selected_images = ! empty( $this->value() ) ? explode( ',', $this->value() ) : array();
                foreach ( $selected_images as $image_url ) {
                    ?>
                        <div class="img-item">
                            <img src="<?php echo esc_url( $image_url ); ?>" />
                            <span class="remove-image">×</span>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
}