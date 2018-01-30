<?php 
    $args = array(
        'offset'      => 0,
        'post_type'   => 'hotel_post',
        'meta_query'    => array(
            array(
                'key' => 'hotel_feature',
                'value' => '1',
            )
        )
    );
    $myhotels = get_posts( $args );

?>

<div class="header-banner">
    <?php 
        foreach ( $myhotels as $hotel ) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id($hotel->ID),full);
            $title = $hotel->post_title;
        ?>
        <div class="header-banner__post">
            <a href="#" title="<?php echo $title; ?>">
                <div class="header-banner__post_image" style="background-image: url('<?php echo $img[0] ?>');"></div>
                <div class="header-banner__post_content">
                    <span><?php echo __('Discover',TEMPLATE_PREFIX) ?></span>
                    <h2><?php echo $title; ?></h2>
                    <hr class="post-reline" />
                </div>
            </a>
        </div>
        <?php     
        }
    ?>
</div>
