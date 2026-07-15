
<?php
$catalog_btn_change = isset($_GET['catalog_btn_change']) ? (int) $_GET['catalog_btn_change'] : themesflat_get_opt('catalog_btn_change');

global $wp_query;

$count = isset( $wp_query->found_posts ) ? $wp_query->found_posts : 0;

?>
<div class="tf-shop-control">
    <div class="tf-control-filter">
        <div class="tf-filter-dropdown">
            <?php if($catalog_btn_change == 1) { ?>
            <p class="title-filter h5">
                <span class="text"><?php echo esc_html__('FILTER','vemus')?></span>
            </p>
            <?php } ?>
            <div class="meta-dropdown-filter">
                <?php dynamic_sidebar('shop-sidebar'); ?>
            </div>
        </div>
    </div>

    <div class="tf-group-layout type-drop">
        <?php if(themesflat_get_opt('catalog_view') == 1) {
            $number_view = isset($_GET['number_view']) && is_numeric($_GET['number_view']) ? (int) $_GET['number_view'] : themesflat_get_opt('number_view');
            $number_view_active = isset($_GET['number_view_active']) && is_numeric($_GET['number_view_active']) ? (int) $_GET['number_view_active'] : themesflat_get_opt('number_view_active');

            $product_style = isset($_GET['product_style']) ? $_GET['product_style'] : themesflat_get_opt('product_style');
            if (isset($_POST['product_style'])) {
                $product_style = sanitize_text_field($_POST['product_style']);
            }
            
            if( $product_style == 'style-list') {
                $number_view_active = 1;
            }
            ?>

            <ul class="tf-control-layout">
                <?php $number_view_active_class = ($number_view_active == 1) ? ' active' : ''; ?>
                
                <?php
                for ($i = 2; $i <= $number_view; $i++) {
                    $layout_class = 'sw-layout-' . $i;
                    $icon_class = 'icon-grid-' . $i;

                    $icon_class .= ' d-none';
                    $layout_class .= ' d-none';

                    if( $i < 4 ) {
                        $icon_class .= ' d-md-flex';
                        $layout_class .= ' d-md-flex';
                    }elseif( $i < 5 ) {
                        $icon_class .= ' d-lg-flex';
                        $layout_class .= ' d-lg-flex';
                    }
                    $active_class = ($i == $number_view_active) ? 'active' : ''; 
                ?>
                    <li class="tf-view-layout-switch <?php echo esc_attr($layout_class); ?> <?php echo esc_attr($active_class); ?>" data-value-layout="tf-col-<?php echo esc_attr($i); ?>" data-style="<?php echo esc_attr($product_style); ?>">
                        <div class="item <?php echo esc_attr($icon_class); ?>">
                            <?php 
                            for ($j = 1; $j <= $i; $j++) {
                                echo '<span></span>';
                            }
                            ?>
                        </div>
                    </li>
                <?php } ?>
                <li class="tf-view-layout-switch d-flex d-md-none sw-layout-2 <?php echo esc_attr( ($number_view_active == 2) ? ' active' : '' ); ?>" data-value-layout="tf-col-2" data-style="<?php echo esc_attr($product_style); ?>">
                    <div class="item icon-grid-2">
                        <span></span>
                        <span></span>
                    </div>
                </li>

                <li class="tf-view-layout-switch d-flex d-md-none sw-layout-1 tf-rotate-90 <?php echo esc_attr( ($number_view_active == 1) ? ' active' : '' ); ?>" data-value-layout="tf-col-1" data-style="<?php echo esc_attr($product_style); ?>">
                    <div class="item icon-grid-3">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </li>
            </ul>

        <?php } ?>

        <?php if(themesflat_get_opt('catalog_sort_by') == 1) { ?>
            <div class="tf-dropdown-sort" data-bs-toggle="dropdown">
                <div class="btn-select">
                    <span class="text-sort-value"><?php echo _e('Alphabetically, A-Z','vemus')?></span>
                    <span class="icon icon-arrow-angle-down"></span>
                </div>
                <div class="dropdown-menu">
                    <div class="select-item" data-sort-value="best-selling">
                        <span class="text-value-item"><?php echo _e('Best selling','vemus')?></span>
                    </div>
                    <div class="select-item active" data-sort-value="a-z">
                        <span class="text-value-item"><?php echo _e('Alphabetically, A-Z','vemus')?></span>
                    </div>
                    <div class="select-item" data-sort-value="z-a">
                        <span class="text-value-item"><?php echo _e('Alphabetically, Z-A','vemus')?></span>
                    </div>
                    <div class="select-item" data-sort-value="price-low-high">
                        <span class="text-value-item"><?php echo _e('Price, low to high','vemus')?></span>
                    </div>
                    <div class="select-item" data-sort-value="price-high-low">
                        <span class="text-value-item"><?php echo _e('Price, high to low','vemus')?></span>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="meta-filter-shop type-drop">
    <div id="product-count-grid" class="count-text-total">
        <?php echo sprintf( _n( 'A total of <span class="count-number">%s</span> result', 'A total of <span class="count-number">%s</span> results', $count ?? 0, 'vemus' ), number_format_i18n($count) ); ?>
    </div>
    <div id="product-count-grid" class="count-text"></div>
    <div id="applied-filters" class="selected-filters"></div>
    <button id="remove-all" class="remove-all-filters" style="<?php echo esc_attr('display: none;'); ?>">
        <span class="text-body"><?php echo _e('Clear all','vemus')?></span>
    </button>
</div>