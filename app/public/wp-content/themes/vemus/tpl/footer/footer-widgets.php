<?php
if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) :         
?> 
    <div class="footer-body p-xl-0 <?php (themesflat_meta( 'footer_class' ) != "" ? esc_attr( themesflat_meta( 'footer_class' ) ):'') ;?>">
        <div class="container">                
            <div class="row-footer">

                <div class="col-s1">
                    <div class="footer-inner-wrap flex-lg-nowrap align-items-end">
                            <div class="footer-col-block">
                                <?php                                         
                                    $widget = themesflat_get_opt("footer1");
                                    themesflat_dynamic_sidebar($widget);
                                ?>
                            </div>
                    </div>
                </div>

                <div class="col-s2">
                    <div class="footer-inner-wrap flex-sm-nowrap s2">
                        <?php                            
                            for ($key = 2;$key < 5;$key++)  {                        
                                ?>
                           
                                <div class="footer-col-block">
                                <?php                                         
                                    $widget = themesflat_get_opt("footer".$key);
                                    themesflat_dynamic_sidebar($widget);
                                ?>
                                </div>
                        <?php } ?>   
                    </div>
                </div>


            </div><!-- /.row -->                  
        </div><!-- /.container --> 
    </div>
<?php endif; ?>