<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= base_url(); ?> ">
            <span class="align-middle">Admin-CI4</span>
        </a>
        <ul class="sidebar-nav">
<<<<<<< HEAD
            <?php foreach ($MenuCategory as $mCategory) : ?>
                <li class="sidebar-header">
                    <?= $mCategory['menu_category']; ?>
                </li>
                <?php foreach ($Menu as $menu) : if ($menu['menu_category'] == $mCategory['menu_category_id']) : ?>
                        <li class="sidebar-item <?= ($segment == $menu['url']) ? 'active' : ''; ?>">
                            <a class="sidebar-link" href="<?= base_url($menu['url']); ?> ">
                                <i class="align-middle" data-feather="<?= $menu['icon']; ?>"></i> <span class="align-middle"><?= $menu['title']; ?></span>
                            </a>
                        </li>
                <?php endif;
                endforeach; ?>
=======
            <li class="sidebar-header">
                Pages
            </li>
            <?php foreach ($Menu as $menu) : ?>
                <li class="sidebar-item <?= ($segment == $menu['url']) ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="<?= base_url($menu['url']); ?> ">
                        <i class="align-middle" data-feather="<?= $menu['icon']; ?>"></i> <span class="align-middle"><?= $menu['title']; ?></span>
                    </a>
                </li>
>>>>>>> master
            <?php endforeach; ?>
        </ul>
    </div>
</nav>