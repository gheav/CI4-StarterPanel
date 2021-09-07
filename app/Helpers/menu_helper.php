<?php
function getMenu($menu_category_id, $role)
{
    $db       = \Config\Database::connect();
    $menu     =  $db->table('user_menu')
        ->orderBy('user_access.id', 'ASC')
        ->join('user_access', 'user_menu.id = user_access.menu_id')
        ->where(['menu_category' => $menu_category_id, 'user_access.role_id' => $role])
        ->get()->getResultArray();
    return $menu;
}
function getSubMenu($menu_id, $role)
{
    $db       = \Config\Database::connect();
    $submenu  = $db->table('user_submenu')
        ->orderBy('user_access.id', 'ASC')
        ->join('user_access', 'user_submenu.id = user_access.submenu_id')
        ->where(['user_submenu.menu' => $menu_id, 'user_access.role_id' => $role])
        ->get()->getResultArray();
    return $submenu;
}
