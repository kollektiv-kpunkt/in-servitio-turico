<?php
if (is_front_page( )) {
    $navbg = "gradient";
} else if (has_post_thumbnail( )) {
    $navbg = "gradient";
} else {
    $navbg = "bg-spred bg-nogradient";
}
?>
<div class="ist-nav-wrapper py-2 fixed w-full z-20 <?= $navbg ?>">
    <div class="ist-nav-content flex justify-between md-container">
        <a href="/" class="ist-noline flex">
            <div class="ist-nav-logo flex items-center gap-x-3">
                <?php
                get_template_part( "template-parts/resources/logo");
                ?>
                <span class="flex flex-col gap-y-1 leading-none text-white">
                    Am 12. Februar<br>
                    <b>SP wählen!</b>
                </span>
            </div>
        </a>
        <div class="ist-nav-menu-wrapper text-white flex items-center">
            <?php
            get_template_part( "template-parts/resources/main-menu");
            ?>
        </div>
        <div class="ist-nav-mobilemenu-tofuburger" hidden>
            <span class="ist-mobilemenu-button-line"></span>
            <span class="ist-mobilemenu-button-line"></span>
            <span class="ist-mobilemenu-button-line"></span>
        </div>
    </div>
    <div class="ist-nav-bg absolute top-0 left-0 w-full h-full"></div>
</div>

<div class="ist-nav-mobilemenu-wrapper z-10 text-white text-end text-3xl">
    <div class="ist-nav-mobilemenu-container py-10 px-16 bg-spred">
    <?php
    get_template_part( "template-parts/resources/main-menu");
    ?>
    </div>
</div>