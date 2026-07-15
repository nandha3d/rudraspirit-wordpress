<?php
add_action( 'init', 'tf_register_postype_megamenu' );
function tf_register_postype_megamenu() {
    $labels = array(
        'name'               => __( 'Mega Menu', 'vemus-addon' ),
        'singular_name'      => __( 'Mega Menu', 'vemus-addon' ),
        'menu_name'          => __( 'Mega Menu', 'vemus-addon' ),
        'name_admin_bar'     => __( 'Mega Menu', 'vemus-addon' ),
        'add_new'            => __( 'Add New', 'vemus-addon' ),
        'add_new_item'       => __( 'Add New Mega Menu', 'vemus-addon' ),
        'new_item'           => __( 'New Mega Menu', 'vemus-addon' ),
        'edit_item'          => __( 'Edit Mega Menu', 'vemus-addon' ),
        'view_item'          => __( 'View Mega Menu', 'vemus-addon' ),
        'all_items'          => __( 'All Mega Menus', 'vemus-addon' ),
        'search_items'       => __( 'Search Mega Menus', 'vemus-addon' ),
        'not_found'          => __( 'No Mega Menus found.', 'vemus-addon' ),
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
        'rewrite'            => array( 'slug' => 'megamenu' ), 
    );

    register_post_type( 'megamenu', $args );
    flush_rewrite_rules();
}


add_action( 'elementor/init', function() {
    add_post_type_support( 'megamenu', 'elementor' );
});


class TF_MegaMenu_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = null ) {
        $indent = str_repeat("\t", $depth);
        $depth_class = ' submenu-depth submenu-' . ($depth + 1);

        // Nếu là submenu thông thường
        if ( isset($args->has_children) && $args->has_children ) {
            $output .= $indent . '<div class="sub-menu mega-menu mega-menu-product ' . esc_attr($depth_class) . '">';
        } else {
            $parent_title = isset($args->parent_item) ? $args->parent_item->title : '';
            $output .= $indent . '<div class="sub-menu ' . esc_attr($depth_class) . '">
                <div class="mega-menu-item">
                    <p class="text-caption menu-heading">' . esc_html($parent_title) . '</p>
                    <ul class="menu-list">';
        }
    }

    function end_lvl( &$output, $depth = 0, $args = null ) {
        if ( isset($args->has_children) && $args->has_children ) {
            $output .= '</div>';
        } else {
            $output .= '</ul>
                </div>
            </div>';
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-depth parentmenu-' . $depth;

        // Nếu là menu cấp 0
        if ( $depth === 0 ) {

            // Mega Menu check
            if ( !empty($item->mega_menu_enabled) && $item->mega_menu_enabled === '1' ) {
                $classes[] = 'tf-megamenu';
                if ( !empty($item->mega_menu_position) && $item->mega_menu_position === 'relative' ) {
                    $classes[] = 'tf-megamenu-relative';
                }
            }

            if ( in_array('current-menu-item', $classes) ) {
                $classes[] = 'active';
            }

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= '<li' . $id . ' class="' . esc_attr( $class_names ) . '">';

            // link
            $atts           = array();
            $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
            $atts['target'] = ! empty( $item->target )     ? $item->target     : '';
            $atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
            $atts['href']   = ! empty( $item->url )        ? $item->url        : '';

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $title = apply_filters( 'the_title', $item->title, $item->ID );
            $output .= '<a' . $attributes . ' class="item-link">' . esc_html( $title ) . '<i class="icon icon-arrow-angle-down"></i></a>';

            // Mega Menu Content
            if ( !empty($item->mega_menu_enabled) && $item->mega_menu_enabled === '1' ) {
                $width_class = '';
                $inline_style = '';

                if ( $item->mega_menu_width_type === 'full' ) {
                    $width_class = 'mega-full';
                } elseif ( $item->mega_menu_width_type === 'custom' && ! empty( $item->mega_menu_custom_width ) ) {
                    $width_class = 'mega-custom';
                    $inline_style = ' style="width:' . esc_attr( $item->mega_menu_custom_width ) . 'px;left:'. esc_attr($item->mega_menu_left_offset) .'"';
                    if ( ! empty( $item->mega_menu_position ) && $item->mega_menu_position === 'relative' ) {
                        $inline_style = ' style="width:' . esc_attr( $item->mega_menu_custom_width ) . 'px !important;left:'. esc_attr($item->mega_menu_left_offset) .'"';
                    }
                }

                $output .= '<div class="sub-menu mega-menu mega-product ' . esc_attr( $width_class ) . '"' . $inline_style . '>';

                if ( ! empty( $item->mega_menu_block_id ) ) {                              
                    $document = Elementor\Plugin::$instance->documents->get_doc_for_frontend( $item->mega_menu_block_id );
                    if ( ! $document || ! $document->is_built_with_elementor() ) {
                        $content = apply_filters( 'the_content', get_post_field( 'post_content', $item->mega_menu_block_id ) );           
                    } else {
                        $content = "";
                        if ( class_exists( "\\Elementor\\Plugin" ) ) {
                            $pluginElementor  = \Elementor\Plugin::instance();
                            $content = $pluginElementor->frontend->get_builder_content_for_display( $item->mega_menu_block_id );  
                        }
                    }
                    $output .= $content;
                }

                $output .= '</div>';
            }

        } else {
            // Submenu item
            $output .= '<li class="' . esc_attr('menu-item-depth parentmenu-' . $depth) . '">';
            $output .= '<a href="' . esc_url( $item->url ) . '" class="menu-link-text link">' . $item->title . '</a>';
        }
    }

    function end_el( &$output, $item, $depth = 0, $args = null ) {
        $output .= '</li>';
    }
}
?>