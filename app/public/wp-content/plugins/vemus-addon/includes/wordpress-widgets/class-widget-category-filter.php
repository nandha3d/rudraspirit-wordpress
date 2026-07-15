<?php
class TFWC_Category_Filter extends WP_Widget {
    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @var array
     */
    protected $defaults;

    /**
     * Constructor
     *
     * @return TFWC_Category_Filter
     */
    public function __construct() {
        $this->defaults = array(
            'title' 	=> 'Category',
            'limit' 	=> 6,
            'hide_empty' => true,
            'show_count' 	=> true,
        );
        parent::__construct(
            'tfwc_category_filter',
            esc_html__( 'TFWC - Category Filter', 'vemus-addon' ),
            array(
                'classname'   => 'widget-facet',
                'description' => esc_html__( 'TFWC Category Filter.', 'vemus-addon' )
            )
        );
    }

    /**
     * Display widget
     */
    public function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );

        $title      = !empty( $title ) ? $title : '';
        $hide_empty = !empty( $hide_empty ) ? (bool) $hide_empty : false;
        $show_count = !empty( $show_count ) ? (bool) $show_count : false;
        $limit = !empty( $limit ) ? absint( $limit ) : 0;

        $categories = get_terms( array(
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'hide_empty' => $hide_empty,
            'number'     => $limit
        ) );

        $layout =themesflat_get_opt( 'shop_layout' );
        if (isset($_GET['sidebar'])){
            $layout = $_GET['sidebar'];
        }

        ob_start();

        if ($layout !== 'filter-top'):
        
        ?>
        <div class="widget-facet">
            <div class="facet-title h6 fw-normal" data-bs-target="#categories" role="button" data-bs-toggle="collapse"
            aria-expanded="true" aria-controls="categories">
                <span class="h6 fw-normal text-uppercase"><?php esc_html_e( $title, 'vemus' ); ?></span>
                <span class="icon ic-accordion-custom"></span>
            </div>

            <div id="categories" class="collapse show">
                <ul class="collapse-body filter-group-check current-scrollbar">
                    <?php foreach ( $categories as $category ) : ?>
                        <?php
                            $checked = '';
                            if ( is_product_category() ) {
                                $current_cat = get_queried_object();
                                if ( $current_cat && $current_cat->term_id == $category->term_id ) {
                                    $checked = 'checked';
                                }
                            }
                        ?>
                        <li class="list-item">
                            <input type="checkbox" name="category" class="tf-check style-2 tf_filter_category" data-category="<?php echo esc_attr( $category->slug ); ?>" id="category-<?php echo esc_attr( $category->term_id ); ?>" <?php echo $checked; ?>>
                            <label for="category-<?php echo esc_attr( $category->term_id ); ?>" class="label">
                                <?php if($show_count) : ?>
                                    <span><?php echo esc_html( $category->name ); ?></span><span class="count-wrap">[ <span class="count"><?php echo esc_html( $category->count ); ?></span> ]</span>
                                <?php endif; ?>
                            </label>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <?php else : ?>
            <div class="dropdown dropdown-filter">
                <div class="dropdown-toggle" id="categories" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" role="button">
                    <span class="text-uppercase"><?php esc_html_e( $title, 'vemus' ); ?></span>
                    <span class="icon icon-arrow-angle-down"></span>
                </div>
                <div class="dropdown-menu" aria-labelledby="categories" style="">
                    <ul class="filter-group-check">
                        <?php foreach ( $categories as $category ) : ?>
                        <?php
                            $checked = '';
                            if ( is_product_category() ) {
                                $current_cat = get_queried_object();
                                if ( $current_cat && $current_cat->term_id == $category->term_id ) {
                                    $checked = 'checked';
                                }
                            }
                        ?>
                        <li class="list-item">
                            <input type="checkbox" name="category" class="tf-check style-2 tf_filter_category" data-category="<?php echo esc_attr( $category->slug ); ?>" id="category-<?php echo esc_attr( $category->term_id ); ?>" <?php echo $checked; ?>>
                            <label for="category-<?php echo esc_attr( $category->term_id ); ?>" class="label">
                                <span><?php echo esc_html( $category->name ); ?></span>
                                <?php if($show_count) : ?>
                                    <span class="count-wrap">[ <span class="count"><?php echo esc_html( $category->count ); ?></span> ]</span>
                                <?php endif; ?>
                            </label>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

		<?php echo ob_get_clean();
    }

    /**
     * Update widget
     */
    public function update( $new_instance, $old_instance ) {
        $instance               = $old_instance;
        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['limit']      =  intval($new_instance['limit']);
        $instance['show_count']     = isset( $new_instance['show_count'] ) ? (bool) $new_instance['show_count'] : false;
        $instance['show_comment']     = isset( $new_instance['hide_empty'] ) ? (bool) $new_instance['hide_empty'] : false;
        return $instance;
    }

    /**
     * Widget setting
     */
    public function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        
        $title = !empty($title) ? $title : '';
        $hide_empty = !empty( $hide_empty ) ? (bool) $hide_empty : false;
        $show_count = !empty( $show_count ) ? (bool) $show_count : false;
        $limit = !empty( $limit ) ? absint( $limit ) : 0;

    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                type="text" value="<?php echo esc_html($title); ?>" />
        </p>
    
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('limit')); ?>"><?php _e('Show Number Category:'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('limit')); ?>" 
                    name="<?php echo esc_attr($this->get_field_name('limit')); ?>" 
                    type="number" min="1" value="<?php echo esc_attr($limit); ?>" />
        </p>
    
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_count); ?> 
                    id="<?php echo esc_attr($this->get_field_id('show_count')); ?>" 
                    name="<?php echo esc_attr($this->get_field_name('show_count')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_count')); ?>">
                <?php _e('Show Number', 'vemus-addon'); ?>
            </label>
        </p>
    
        <p>
            <input class="checkbox" type="checkbox" <?php checked($hide_empty); ?> 
                    id="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>" 
                    name="<?php echo esc_attr($this->get_field_name('hide_empty')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('hide_empty')); ?>">
                <?php _e('Hide category no product', 'vemus-addon'); ?>
            </label>
        </p>
    <?php
    }
}

add_action( 'widgets_init', 'themesflat_register_category_filter' );

/**
 * Register widget
 *
 * @return void
 * @since 1.0
 */
function themesflat_register_category_filter() {
    register_widget( 'TFWC_Category_Filter' );
}