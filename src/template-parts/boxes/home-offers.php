<?php
    $selected_offer = rwmb_meta('push_offer');
    $offers         = get_offers_of_all_hotels(); 
    $offers_to_display = array();
    foreach ($offers as $offer) {        
        $rate_name = $offer->rate->name;
        foreach ($selected_offer as $selections) {
            $code = $selections["push_offers_code"];
            if ( $code == $rate_name ) {
                $offers_to_display[$rate_name] = $offer;
            }
        }
    }
    if( !empty($offers_to_display) ):
?>
<section class="block">
    <div class="container">
        <h3 class="block-title"><?php _e('Special Offers','studio2let') ?></h3>
        <div class="row">
            <?php
                foreach ($offers_to_display as $j => $item) {
                    $offer_name = $item->hotel;
                    $offer_image = $item->rate->image->url;
                    $offer_title = $item->rate->title;
                    $offer_desc = $item->rate->html_description;
                    $offer_booking = $item->quotation->plainBookLink;
                    ?>
                        <div class="home-post col-md-6">
                            <div class="home-post_image" style="background-image: url('<?php echo $offer_image; ?>');"></div>
                            <div class="home-post_content">
                                <span class="home-post_subtitle"><?php echo $offer_name; ?></span>
                                <h4 class="home-post_title"><?php echo $offer_title; ?></h4>
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
                                        <a class="btn btn-default js-see-more" href="javascript:void(0)" title="<?php _e('See More','studio2let') ?>"><?php _e('See More','studio2let') ?></a>
                                    </div>
                                    <div class="col">
                                        <a class="btn btn-red" href="<?php echo $offer_booking; ?>" title="<?php _e('Book Now','studio2let') ?>"><?php _e('Book Now','studio2let') ?></a>
                                    </div>
                                </div>
                            </div>
                        </div> 
            <?php } ?>
        </div>
    </div> 
</section>
<?php endif; ?>