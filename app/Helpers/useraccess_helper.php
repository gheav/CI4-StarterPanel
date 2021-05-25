<?php
function check_menu_access($role_id, $menu_id)
{
    $db     = \Config\Database::connect();
    $result = $db->table('user_access')->where([
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ])->countAllResults();
    if ($result > 0) {
        return "checked";
    }
}
