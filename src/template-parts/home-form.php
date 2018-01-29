<?php 
    $args = array(
        'offset'      => 0,
        'post_type'   => 'hotel_post',
    );
    $myhotels = get_posts( $args );
    $text = studio2let_get_qs_text();
?>
<script type='text/javascript'>
    var icl_vars = {"current_language":"<?php echo studio2let_get_websdk_locale(); ?>"};
</script>
<div class="clearfix">
    <form class="header-qs js_qs-form">
        <div class="header-qs_fields">
            <div class="qs__field qs__select">
                <select class="js_qs-form__hotel qs__destination" tabindex="2" required name="qs_form__hotel" data-placeholder="<?php echo $text['choose'] ?>">
                    <option value="" disabled selected><?php echo $text['choose'] ?></option>
                    <?php 
                        foreach ( $myhotels as $hotel ) {
                            $title = $hotel->post_title;
                            $hotel_hid = get_post_meta($hotel->ID, 'hotel_fb_hid', true);
                            echo '<option value="'.$hotel_hid.'">'.$title.'</option>';
                        }
                    ?>
                </select>  
            </div>
            <div class="qs__field qs__datepicker qs__field-checkin">
                <span><?php echo $text['arrival'] ?></span>
                <input class="qs__checkin js_qs-form__checkin" name="qs_form__checkin" value="">
            </div>
            <div class="qs__field qs__datepicker qs__field-checkout">
                <span><?php echo $text['departure'] ?></span>
                <input class="qs__checkout js_qs-form__checkout" name="qs_form__checkout" value="">
            </div>
            <label class="qs__field qs__label"><?php echo $text['promo'] ?> <?php echo $text['cancel'] ?></label>
        </div>
        <div class="header-qs_btn">
            <button class="qs__btn-submit js_qs-form__submit" type="submit"><?php echo $text['submit'] ?></button>
        </div>
    </form>
</div>