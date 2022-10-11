<?php
    $id = 'image-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    // Create class attribute allowing for custom "className" and "align" values.
    $className = 'vc-image';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }
    if( !empty($block['align']) ) {
        $className .= ' align' . $block['align'];
    }
    if( $is_preview ) {
        $className .= ' is-admin';
    }

    $vc_height = get_field('vc_height');
    $vc_title = get_field('vc_title');
    $vc_image = get_field('vc_image');

?>
    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="background-image: url(<?php echo $vc_image; ?>);height: <?php echo $vc_height; ?>;">
        <div class="container"> 
            <div class="image-content">
                <div class="chapter-title"><?php echo $vc_title; ?></div>
            </div>
        </div>
    </div>
<?php    