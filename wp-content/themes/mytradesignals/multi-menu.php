<?php
$postCustom = get_post_custom(get_the_ID());

for ($i = 1; $i < 6; $i++) {
    if (isset($postCustom['menu_selector_' . $i]) &&
        $menuId = $postCustom['menu_selector_' . $i][0]
    ) {
        $menuMeta = wp_get_nav_menu_object($menuId);
        ?>
        <aside id="nav_menu-10" class="widget widget_nav_menu">
            <h3 class="widget-title"><?php echo $menuMeta->name; ?></h3>
            <?php
            wp_nav_menu(['menu' => $menuId]);
            ?>
        </aside>
    <?php
    }
}
?>