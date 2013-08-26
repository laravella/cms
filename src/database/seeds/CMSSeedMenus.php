<?php

use Laravella\Crud\Log;

class CMSSeedMenus extends Seeder
{

        private function __addMenu($label, $href, $iconClass = 'icon-file', $parentId = null) {
            $group = array('label'=>$label, 'href'=>$href, 'parent_id'=>$parentId, 'icon_class'=>$iconClass);     
            $menuId = DB::table('_db_menus')->insertGetId($group);
            Log::write('info', $label.' menu created');
            return $menuId;
        }
        
        private function __addMenuPermissions($menuId, $groupName) {
            $usergroup = DB::table('usergroups')->where('group', $groupName)->first();
            if (is_object($usergroup)) {
                $usergroupId = $usergroup->id;
                DB::table('_db_menu_permissions')->insertGetId(array('menu_id'=>$menuId, 'usergroup_id'=>$usergroupId));
            }
        }
        
	public function run()
	{

//		DB::table('_db_menus')->delete();
//		DB::table('_db_menu_permissions')->delete();
                
                $topMenuId = $this->__addMenu('TopMenu', '', 'icon-file', null);
                DB::table('_db_menus')->where("id", $topMenuId)->update(array("parent_id"=>$topMenuId));

                $contentId = $this->__addMenu('Contents', '', 'icon-file', $topMenuId);
                $this->__addMenu('Pages', '/db/select/contents', 'icon-file', $contentId);
                //$this->__addMenu('Posts', '/admin/posts/index', 'icon-file', $contentId);
                $this->__addMenu('Post Categories', '/db/select/categories', 'icon-file', $contentId);
                $this->__addMenu('divider', '/db/select/users', 'icon-file', $contentId);
//                $this->__addMenu('Media Upload', '/admin/medias/index', 'icon-file', $contentId);
                $this->__addMenu('Media', '/db/select/medias', 'icon-file', $contentId);
                $this->__addMenu('Collections', '/db/select/mcollections', 'icon-file', $contentId);
                $this->__addMenu('Galleries', '/db/select/galleries', 'icon-file', $contentId);
                
                $this->__addMenuPermissions($contentId, 'superadmin');
                $this->__addMenuPermissions($contentId, 'admin');
		
	}
}
?>