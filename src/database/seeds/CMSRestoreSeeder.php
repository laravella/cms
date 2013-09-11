<?php

class CMSRestoreSeeder {

    private function __restoreTable($tableName) {
        $sql = "create table `_db_bak_$tableName` as select * from `$tableName`";
        echo DB::unprepared($sql) . "\n";
    }
    
    public function run() {
        $this->__restoreTable("categories");
        $this->__restoreTable("category_content");
        $this->__restoreTable("comments");
        $this->__restoreTable("contact_types");
        $this->__restoreTable("contacts");
        $this->__restoreTable("content_media");
        $this->__restoreTable("content_types");
        $this->__restoreTable("contentmetas");
        $this->__restoreTable("contents");
        $this->__restoreTable("galleries");
        $this->__restoreTable("groups");
        $this->__restoreTable("links");
        $this->__restoreTable("maps");
        $this->__restoreTable("mcollection_media");
        $this->__restoreTable("mcollections");
        $this->__restoreTable("medias");
        $this->__restoreTable("migrations");
        $this->__restoreTable("modules");
        $this->__restoreTable("product_categories");
        $this->__restoreTable("products");
        $this->__restoreTable("roles");
        $this->__restoreTable("throttle");
        $this->__restoreTable("usergroups");
        $this->__restoreTable("users");
        $this->__restoreTable("users_groups");
    }
}
?>
