<header class="header">
    <div class="header-top">
        <a class="header-top__logo" href="#" title="Studio 2 Let">
            <i class="icon-logo"></i>
        </a>
        <div class="header-top__menu">
            <div class="header-top__menu--item header-top__menu--language" data-chosen-lang>
                <?php echo ICL_LANGUAGE_CODE; ?>
                <i class="icon-select"></i>
            </div>
            <div class="header-top__menu--item header-top__menu--mail">
                <i class="icon-mail"></i>
            </div>
        </div>
    </div>
    <?php
        get_template_part('template-parts/home', 'banner');
        get_template_part('template-parts/home', 'form');
    ?>
    <div class="header-scrollbtn" data-scroll-to="main">
        <i class="icon-scroll-icon"></i>
    </div>
    <div class="header-language_box">
        <span class="header-language_close" data-chosen-lang>&nbsp;</span>
        <?php do_action('wpml_add_language_selector'); ?>
    </div>
</header>