<?php 
    $service_title = rwmb_meta('ser_title');
    $service_content1 = rwmb_meta('ser_mid_content');
    $service_content2 = rwmb_meta('ser_content');
?>

<section class="block">
    <div class="container">
        <div class="row justify-content-md-center">
            
            <div class="col-md-8 center">
                <h3 class="block-title"><?php echo $service_title; ?></h3>
                <?php if ($service_content1) : ?>
                <div class="block-paragraph">
                    <?php echo $service_content1; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($service_content2) : ?>
        <div class="row">
            <?php echo $service_content2; ?>
        </div>
        <?php endif; ?>
    </div>
</section>