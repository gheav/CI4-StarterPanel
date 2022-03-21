<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{

    public function getMenuCategory($menuCategoryID = false)
    {

        if ($menuCategoryID) {
            return $this->db->table('user_menu_category')->where(['id' => $menuCategoryID['id']])->get()->getRowArray();
        }
        return $this->db->table('user_menu_category')
            ->get()->getResultArray();
    }
    public function getMenu($menuID = false)
    {
        if ($menuID) {
            return $this->db->table('user_menu')
                ->select(
                    '*,
                    user_menu_category.menu_category AS category,
                    user_menu.menu_category AS menu_category_id, 
                    user_menu.id AS menu_id
                    '
                )
                ->join('user_menu_category', 'user_menu.menu_category = user_menu_category.id')
                ->where(['id' => $menuID['menu_id']])
                ->get()->getRowArray();
        }
        return $this->db->table('user_menu')
            ->select(
                '*,
                user_menu_category.menu_category AS category,
                user_menu.menu_category AS menu_category_id, 
                user_menu.id AS menu_id
                '
            )
            ->join('user_menu_category', 'user_menu.menu_category = user_menu_category.id')
            ->get()->getResultArray();
    }

    public function getSubmenu()
    {
        return $this->db->table('user_submenu')
            ->select('*,
            user_menu.title AS menu_title,
            user_submenu.menu AS menu_id,
            user_submenu.id AS submenu_id,
            user_submenu.title AS submenu_title,
            user_submenu.url AS submenu_url,

            ')
            ->join('user_menu', 'user_submenu.menu = user_menu.id')
            ->join('user_menu_category', 'user_menu.menu_category = user_menu_category.id')
            ->get()->getResultArray();
    }

    public function createMenuCategory($dataMenuCategory)
    {
        return $this->db->table('user_menu_category')->insert([
            'menu_category'        => $dataMenuCategory['inputMenuCategory']
        ]);
    }
    public function updateMenuCategory($menuCategoryID)
    {
        return $this->db->table('user_menu_category')->update([
            'menu_category'        => $menuCategoryID['inputMenuCategory']
        ]);
    }
    public function createMenu($dataMenu)
    {
        return $this->db->table('user_menu')->insert([
            'menu_category'     => $dataMenu['inputMenuCategory2'],
            'title'             => $dataMenu['inputMenuTitle'],
            'url'               => $dataMenu['inputMenuURL'],
            'icon'              => $dataMenu['inputMenuIcon'],
            'parent'            => 0
        ]);
    }

    public function createSubMenu($dataSubmenu)
    {
        $this->db->transBegin();
        $this->db->table('user_submenu')->insert([
            'menu'            => $dataSubmenu['inputMenu1'],
            'title'           => $dataSubmenu['inputSubmenuTitle'],
            'url'             => $dataSubmenu['inputSubmenuURL']
        ]);
        $this->db->table('user_menu')->update(['parent' => 1], ['id' => $dataSubmenu['inputMenu']]);
        if ($this->db->transStatus() === FALSE) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    public function getMenuByUrl($menuUrl)
    {
        return $this->db->table('user_menu')
            ->where(['url' => $menuUrl])
            ->get()->getRowArray();
    }
}
