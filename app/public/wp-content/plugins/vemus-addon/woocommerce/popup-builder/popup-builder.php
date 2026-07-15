<?php
add_action( 'init', 'tf_register_postype_popup' );
function tf_register_postype_popup() {
    $labels = array(
        'name'               => __( 'Popup Builder', 'vemus' ),
        'singular_name'      => __( 'Popup Builder', 'vemus' ),
        'menu_name'          => __( 'Popup Builder', 'vemus' ),
        'name_admin_bar'     => __( 'Popup Builder', 'vemus' ),
        'add_new'            => __( 'Add New', 'vemus' ),
        'add_new_item'       => __( 'Add New Popup', 'vemus' ),
        'new_item'           => __( 'New Popup', 'vemus' ),
        'edit_item'          => __( 'Edit Popup', 'vemus' ),
        'view_item'          => __( 'View Popup', 'vemus' ),
        'all_items'          => __( 'All Popups', 'vemus' ),
        'search_items'       => __( 'Search Popups', 'vemus' ),
        'not_found'          => __( 'No Popups found.', 'vemus' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true, 
        'publicly_queryable' => true, 
        'exclude_from_search' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true, 
        'menu_icon'          => 'dashicons-screenoptions',
        'supports'           => array( 'title', 'editor' ),
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'has_archive'        => false,
        'rewrite'            => array( 'slug' => 'popup_builder' ), 
    );

    register_post_type( 'popup_builder', $args );

    flush_rewrite_rules();
}



add_action( 'elementor/init', function() {
    add_post_type_support( 'popup_builder', 'elementor' );
});


?>