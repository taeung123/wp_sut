<?php
    $id = 'fancybox-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'fancybox';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }
    if( $is_preview ) {
        $className .= ' is-admin';
    }
    $padding_top = get_field('padding_top');
    $padding_bottom = get_field('padding_bottom');
    $one_page = get_field('one_page');
    $has_one = ($one_page== 'yes') ? 'has-onepage' : '';
?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> <?php echo $has_one; ?>" style="padding-top:<?php echo $padding_top; ?>; padding-bottom: <?php echo $padding_bottom; ?>;">
        <div class="container">  
                <?php if( have_rows('fancy_items') ): ?>
                    <div class="fancy-items fancy-row row">
                        <?php 
                        $i = 1;
                        while( have_rows('fancy_items') ): the_row(); 
                            $vc_image = get_sub_field('vc_image');
                            $vc_title = get_sub_field('vc_title');
                            $vc_link = get_sub_field('vc_link');
                        ?>
                            <div class="fancy-item col-lg-4 col-md-6 col-sm-6 col-12">  
                                <div class="fancy-content">
                                    <a class="fancy-link" href="<?php echo $vc_link; ?>">
                                        <div class="fancy-icon">
                                            <img src="<?php echo $vc_image; ?>" alt="image">
                                            <?php if($one_page == 'yes'): ?>
                                                <span class="vc-number"><?php echo '#'.$i; ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content-wrap">
                                            <?php if (!empty($vc_title) ): ?>
                                                <h3 class="fancy-title"> <?php echo $vc_title; ?> </h3>
                                            <?php endif ?>
                                            <?php if($one_page == 'yes'): ?>
                                                <div class="btn-readmore"><?php echo esc_html__('Read the chapter','vicoders') ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p>Please add some box.</p>
                <?php endif; ?>   
            
        </div>
        <?php if($one_page == 'yes'): ?>
            <ul class="fancybox-quick">
                <li class="heading"><?php echo esc_html('Quick Links') ?></li>
                <?php    
                while( have_rows('fancy_items') ): the_row();
                    $vc_title = get_sub_field('vc_title');
                    $vc_link = get_sub_field('vc_link');
                ?>
                <li class="item"><a href="<?php echo $vc_link; ?>"><?php echo $vc_title; ?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
