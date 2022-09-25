<?php
wp_nav_menu(array(
    'theme_location' => 'ist-main-nav',
    'menu_class' => 'ist-nav-menu',
    'container' => 'ul',
    'container_class' => 'ist-nav-menu',
    'container_id' => 'primary-menu',
    'echo' => true,
    'fallback_cb' => 'wp_page_menu',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth' => 0,
    'walker' => '',
    'item_spacing' => 'preserve',
    'add_li_class' => 'ist-nav-menu-item',
) );
?>