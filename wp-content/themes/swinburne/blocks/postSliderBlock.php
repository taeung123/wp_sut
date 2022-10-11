<?php
$id = 'postslider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'postslider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}

$vc_column = get_field('vc_column');
$choose_term = get_field('choose_term');
$term = get_field('term');
$post_count = get_field('post_count');
$order = get_field('order');
$order_by = get_field('order_by');

if ($choose_term == 'all') {
    $arg = [
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'orderby'             => 'post-date',
        'order '              => $order,
        'ignore_sticky_posts' => true,
        'posts_per_page'      => $post_count,
        'paged'               => false,
    ];
}
else {
   $arg = [
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'orderby'             => $order_by,
        'order '              => $order,
        'ignore_sticky_posts' => true,
        'posts_per_page'      => $post_count,
        'paged'               => false,
        'tax_query'           => [
            [
                'taxonomy'  => 'category',
                'field'     => 'term_id',
                'terms'     => $term,
                'operator'  => 'IN',
            ]
        ]
    ]; 
}
$query = new \WP_Query( $arg );
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
    <div class="container">
        <div class="post-slider-items">
            <?php 
            if (!$query->have_posts()): ?>

                <div class="alert alert-warning">
                    <?php   echo 'Sorry, no results were found.';  ?>
                </div>

                <?php  echo get_search_form(false); ?>
                
            <?php endif; ?>
            
            <?php while ($query->have_posts()):
            
                 $query->the_post() ?>
                <div id = "post_item" class="post-item"> 
                    <article <?php echo post_class() ?> >
                        <div class="post-content">
                            <div class="post-thumbnail">
                                <a href="<?php echo get_the_permalink() ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url() ?>"
                                        alt="<?php echo get_the_permalink() ?>" class="img-event"
                                        style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
                                </a>
                            </div>
                            <header>
                                <h3 class="entry-title">
                                    <a href="<?php echo esc_url(get_permalink()) ; ?>"><?php echo  get_the_title(); ?></a>
                                </h3>
                                <p>
                                <?php echo  wp_trim_words(get_the_content(), $num_words = 15) ?>
                                </p>
                                <div class="go-to-link">
                                    <a href="<?php echo get_the_permalink() ?>"><?php echo pll_current_language('slug') === 'vi' ?  'Tìm hiểu thêm' :  'Read more' ?><i
                                            class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </header>
                        </div>
                    </article>

                </div>

            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div> 