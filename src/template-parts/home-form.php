<?php 
    $args = array(
        'offset'      => 0,
        'post_type'   => 'hotel_post',
    );
    $myhotels = get_posts( $args );
?>
<div class="header-qs">
    <div class="header-qs_fields">
        <div class="qs__field qs__select">
            <select class="js_qs__sites" name="Hotelnames">
                <option default>Select Property</option>
                <?php 
                    foreach ( $myhotels as $hotel ) {
                        $title = $hotel->post_title;
                        echo '<option value="'.$title.'">'.$title.'</option>';
                    }
                ?>
            </select>  
        </div>
        <div class="qs__field qs__datepicker qs__field-checkin">
            <span>Arrival</span>
            <input class="qs__checkin js_qs__checkin" readonly="readonly">
        </div>
        <div class="qs__field qs__datepicker qs__field-checkout">
            <span>Departure</span>
            <input class="qs__checkout js_qs__checkuot" readonly="readonly">
        </div>
        <label class="qs__field qs__label">Promo code cancel booking</label>
    </div>
    <div class="header-qs_btn">
        <button class="qs__btn-submit" type="submit">Book Today</button>
    </div>
</div>