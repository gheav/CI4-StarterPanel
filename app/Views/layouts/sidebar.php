<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= base_url(); ?> ">
            <span class="align-middle">CI4 - Starter Panel</span>
        </a>
        <ul class="sidebar-nav">
            <?php foreach ($MenuCategory as $mCategory) : ?>
                <li class="sidebar-header">
                    <?= $mCategory['menu_category']; ?>
                </li>
                <?php
                $Menu = getMenu($mCategory['menuCategoryID'], $user['role']);
                foreach ($Menu as $menu) :
                    if ($menu['parent'] == 0) :
                ?>
                        <li class="sidebar-item <?= ($segment == $menu['url']) ? 'active' : ''; ?>">
                            <a class="sidebar-link" href="<?= base_url($menu['url']); ?> ">
                                <i class="align-middle" data-feather="<?= $menu['icon']; ?>"></i> <span class="align-middle"><?= $menu['title']; ?></span>
                            </a>
                        </li>
                    <?php
                    else :
                        $SubMenu =  getSubMenu($menu['menu_id'], $user['role']);
                    ?>
                        <li class="sidebar-item <?= ($segment == $menu['url']) ? 'active' : ''; ?>">
                            <a data-bs-target="#<?= $menu['url'] ?>" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="<?= ($segment == $menu['url']) ? 'true' : 'false'; ?>">
                                <i class="align-middle" data-feather="<?= $menu['icon']; ?>"></i> <span class="align-middle"><?= $menu['title']; ?></span>
                            </a>
                            <ul id="<?= $menu['url'] ?>" class="sidebar-dropdown list-unstyled collapse <?= ($segment == $menu['url']) ? ' show' : ''; ?> " data-bs-parent="#sidebar">
                                <?php foreach ($SubMenu as $subMenu) : ?>
                                    <li class="sidebar-item <?= ($subsegment == $subMenu['url']) ? 'active' : ''; ?>">
                                        <a class="sidebar-link" href="<?= base_url($menu['url'] . '/' . $subMenu['url']); ?>">
                                            <?= $subMenu['title']; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                <?php
                    endif;
                endforeach;
                ?>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>