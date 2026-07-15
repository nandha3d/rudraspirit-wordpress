<?php 

// ADD SECTION TOP
$wp_customize->add_section('section_ft_top',array(
    'title'         => 'Top',
    'priority'      => 3,
    'panel'         => 'footer_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/footer/top.php";

// ADD SECTION FOOTER

// ADD SECTION BOTTOM
$wp_customize->add_section('section_bottom',array(
    'title'         => 'Bottom',
    'priority'      => 5,
    'panel'         => 'footer_panel',
)); 
require THEMESFLAT_DIR . "inc/customizer/footer/bottom.php";



