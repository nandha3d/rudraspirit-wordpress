
<?php
    class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
        function start_lvl( &$output, $depth = 0, $args = null ) {
            $indent = str_repeat("\t", $depth);

            $depth_class = ' submenu-depth submenu-' . ($depth + 1);

            if (isset($args->has_children) && $args->has_children) {
                $output .= $indent . '<div class="sub-menu mega-menu mega-menu-product' . esc_attr($depth_class) . '">';
            } else {
                $parent_title = isset($args->parent_item) ? $args->parent_item->title : '';

                $output .= $indent . '<div class="sub-menu' . esc_attr($depth_class) . '">
                    <div class="mega-menu-item">
                        <p class="text-caption menu-heading">' . esc_html($parent_title) . '</p>
                        <ul class="menu-list">';
            }
        }
    
        function end_lvl( &$output, $depth = 0, $args = null ) {
            

            if (isset($args->has_children) && $args->has_children) {
                $output .= '</div>';
            } else {
                $output .= '</ul>
                    </div>
                </div>';
            }
        }
    
        function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;

            $classes[] = 'menu-item-depth parentmenu-' . $depth;

            if ($depth === 0) {
                $classes[] = 'menu-item position-relative';
                if (in_array('current-menu-item', $classes)) {
                    $classes[] = 'active';
                }
                $classes = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
                $class_names = ! empty( $classes ) ? ' class="' . esc_attr( $classes ) . '"' : '';
                $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
                $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
                $output .= '<li' . $id . $class_names .'>';
                $output .= '<a href="' . esc_url( $item->url ) . '" class="item-link">' . $item->title . '<i class="icon icon-arrow-angle-down"></i></a>';
            } else {
                $output .= '<li class="' . esc_attr('menu-item-depth parentmenu-' . $depth) . '">';
                $output .= '<a href="' . esc_url( $item->url ) . '" class="menu-link-text link">' . $item->title . '</a>';
            }
        }
      
        function end_el( &$output, $item, $depth = 0, $args = null ) {
            $output .= '</li>';
        }
    }    
?>
<?php $walker = class_exists('TF_MegaMenu_Walker') ? new TF_MegaMenu_Walker() : new WP_Bootstrap_Navwalker; ?>
<div class="nav-wrap">
    <nav id="mainnav" class="box-navigation" role="navigation">
        <?php
            wp_nav_menu( array( 
                'theme_location' => 'primary', 
                'menu_class' => 'box-nav-menu', 
                'fallback_cb' => 'themesflat_menu_fallback', 
                'container' => false, 
                'walker' => $walker, 
            ) );
        ?>
    </nav><!-- #site-navigation -->  
</div><!-- /.nav-wrap -->   

