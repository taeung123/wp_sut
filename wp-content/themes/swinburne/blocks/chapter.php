<?php
    $id = 'chapter-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'vc-chapter';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }
    if( $is_preview ) {
        $className .= ' is-admin';
    }

    $vc_name = get_field('vc_name');
    $vc_title = get_field('vc_title');
    $vc_image = get_field('vc_image');
    $vc_description = get_field('vc_description');
    $vc_content = get_field('vc_content');
    $scroll_id = get_field('scroll_id');
?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
        <div class="chapter-heading">
            <div class="container"> 
                <div class="heading-wrap">
                    <div class="heading-content"  >
                        <div id="<?php echo $scroll_id; ?>" class="chapter-name"><?php echo $vc_name; ?></div>
                        <div class="chapter-title"><?php echo $vc_title; ?></div>
                    </div>
                        <div class="heading-image">
                            <img src="<?php echo $vc_image; ?>" alt="image">
                        </div>
               </div>    
                <div class="chapter-desc"> <?php echo $vc_description; ?>
                </div>
                
            </div>
        </div>
        <div class="chapter-content">
            <div class="container">
                <?php echo $vc_content; ?>
            </div>
        </div>
    </div>
<?php    