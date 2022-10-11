<?php
    $id = 'vc-accordion-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'vc-accordion';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }
    if( $is_preview ) {
        $className .= ' is-admin';
    }

    $color = get_field('color');
    $padding_top = get_field('padding_top');
    $padding_bottom = get_field('padding_bottom');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" >
    <div class="container">
        <div class="accordion-content">
        <?php if( have_rows('content_accordions') ): ?>
            <ul class="accordions">
                <?php while( have_rows('content_accordions') ): the_row(); 
                    $title_accordion = get_sub_field('title_accordion');
                    $content = get_sub_field('content');
                ?>
                    <li class="accordion-menu">
                        <span class="heading" style="color: <?php echo $color ?>;"><span><?php echo  $title_accordion ?></span><i class="fa fa-plus"></i></span>
                        <div class="accordion-wrap">
                            <div class="nf-row row">
                               <?php if( $content ):   ?>
    
                                    <div class="nf-col col-lg-12 col-md-12">
                                        <div class="accordion-child ">
                                            <?php echo $content; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>  
                <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>