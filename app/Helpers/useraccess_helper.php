<?php
function check_menuCategory_access($role_id, $menu_category_id)
{
    $db                     = \Config\Database::connect();
    $accessMenuCategory     = $db->table('user_access')->where(['role_id' => $role_id, 'menu_category_id' => $menu_category_id])->countAllResults();
    if ($accessMenuCategory > 0) {
        return "checked";
    }
}
function check_menu_access($role_id, $menu_id)
{
    $db                 = \Config\Database::connect();
    $accessMenu         = $db->table('user_access')->where(['role_id' => $role_id, 'menu_id' => $menu_id])->countAllResults();
    if ($accessMenu > 0) {
        return "checked";
    }
}
