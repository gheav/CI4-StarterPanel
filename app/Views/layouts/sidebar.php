<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="<?= base_url(); ?> ">
            <span class="align-middle">Admin-CI4</span>
        </a>
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            <?php foreach ($Menu as $menu) : ?>
                <li class="sidebar-item <?= ($segment == $menu['url']) ? 'active' : ''; ?>">
                    <a class="sidebar-link" href="<?= base_url($menu['url']); ?> ">
                        <i class="align-middle" data-feather="<?= $menu['icon']; ?>"></i> <span class="align-middle"><?= $menu['title']; ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>