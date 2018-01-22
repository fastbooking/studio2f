<?php 
    $args = array(
        'offset'      => 0,
        'post_type'   => 'hotel_post',
    );
    $myhotels = get_posts( $args );

?>

<div class="header-banner">
    <?php 
        foreach ( $myhotels as $hotel ) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($hotel->ID),full);
            $title = $hotel->post_title;
        ?>
        <div class="header-banner__post" style="background-image: url('<?php echo $img[0] ?>');">
            <div class="header-banner__post_content">
                <span><?php echo __('Discover',TEMPLATE_PREFIX) ?></span>
                <h2><?php echo $title; ?></h2>
                <hr class="post-reline" />
            </div>
        </div>
        <?php     
        }
    ?>
</div>
