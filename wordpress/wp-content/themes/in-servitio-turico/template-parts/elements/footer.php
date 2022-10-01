<div class="bg-spred-120 text-white mt-44 py-24">
    <div class="sm-container">
        <?php if ( is_active_sidebar( 'footer_widget' ) ) : ?>
            <?php dynamic_sidebar( 'footer_widget' ); ?>
        <?php endif; ?>
    </div>
</div>

<div class="ist-bottom-bar bg-spblack text-white py-3">
    <div class="ist-footer-wrapper flex justify-between md-container items-center">
        <div class="ist-footer-left-container flex gap-8 items-center">
            <div class="ist-footer-logo w-12">
                <?php
                get_template_part( "template-parts/resources/logo");
                ?>
            </div>
            <div class="ist-footer-menu-wrapper">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'ist-footer-nav',
                ) );
                ?>
            </div>
        </div>
        <div class="ist-footer-right-container">
            <a href="https://kpunkt.ch" class="ist-noline">Built with 💞 | Webdesign by <strong>K.</strong></a>
        </div>
    </div>
</div>