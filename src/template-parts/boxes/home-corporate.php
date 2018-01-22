<section class="block">
    <div class="container">
        <div class="row justify-content-md-center">
            <?php 
                $cop_title = rwmb_meta('cor_title');
                $cop_content1 = rwmb_meta('cor_mid_content');
                $cop_content2 = rwmb_meta('cor_content');
            ?>
            <div class="col-md-8 center">
                <h3 class="block-title"><?php echo $cop_title; ?></h3>
                <?php if ($cop_content1) : ?>
                <div class="block-paragraph">
                    <?php echo $cop_content1; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($cop_content2) : ?>
        <div class="row">
            <?php echo $cop_content2; ?>
        </div>
        <?php endif; ?>
    </div>
</section>