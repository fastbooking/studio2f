<?php
    $list_hotel = get_posts(array(
        'post_status'      => 'publish',
        'post_type'        => 'hotel_post',
    ));
    $hids = '';
    foreach ($list_hotel as $hotel) {
        $hids .= get_post_meta($hotel->ID, 'hotel_fb_hid', true).',';
    }
    $locale = studio2let_get_websdk_locale();
    $currency = studio2let_get_websdk_currency();
    $websdk_config = array(
        'output'    => 'json',
        'hids'      => rtrim($hids, ','),
        'locale'    => $locale,
        'currency'  => $currency,
        '_authCode' => STUDIO_WEBSDK_TOKEN
    );
    $response = wp_remote_get('http://websdk.fastbooking-cloud.ch/groupOffers?'.http_build_query($websdk_config));
    $offers = json_decode( wp_remote_retrieve_body($response))->data;
    
    if( !empty($offers)) : 
?>
<section class="block">
    <div class="container">
        <h3 class="block-title"><?php _e('Special Offers',TEMPLATE_PREFIX) ?></h3>
        <?php 
            foreach ($offers as $i=>$offer) {
                $offer = $offers[$i];
                $offer_hotel = $offer->prop->title;
                $rates = $offer->rates;
        ?>
        <div class="row">
            <?php
                foreach ($rates as $j => $item) {
                    $offer_image = $item->rate->image->url;
                    $offer_name = $item->rate->title;
                    $offer_desc = $item->rate->html_description;
                    $offer_booking = $item->quotation->plainBookLink;
                    ?>
                        <div class="home-post col-md-6">
                            <div class="home-post_image" style="background-image: url('<?php echo $offer_image; ?>');"></div>
                            <div class="home-post_content">
                                <span class="home-post_subtitle"><?php echo $offer_hotel; ?></span>
                                <h4 class="home-post_title"><?php echo $offer_name; ?></h4>
                                <div class="home-post_desc">
                                    <?php echo rojak_get_first_words($item->rate->plain_description,50); ?>
                                </div>
                                <div class="full-text">
                                    <span class="close-text js-see-more">
                                        <i class="fa fa-close"></i>
                                    </span>
                                    <?php echo $offer_desc; ?>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-default js-see-more" href="javascript:void(0)" title="<?php _e('See More',TEMPLATE_PREFIX) ?>"><?php _e('See More',TEMPLATE_PREFIX) ?></a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-red" href="<?php echo $offer_booking; ?>" title="<?php _e('Book Now',TEMPLATE_PREFIX) ?>"><?php _e('Book Now',TEMPLATE_PREFIX) ?></a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php
                }
            ?>
        </div>
        <?php } ?>
    </div> 
</section>
<?php endif; ?>