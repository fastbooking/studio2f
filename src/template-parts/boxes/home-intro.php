<?php 
    $intro_title = rwmb_meta('intro_title');
?>
<section class="block">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-8 center">
                <h3 class="block-title"><?php echo $intro_title; ?></h3>
                <div class="block-paragraph">
                    <?php echo the_content(); ?>
                </div>
            </div>
        </div>
    </div> 
</section>