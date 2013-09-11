<?php namespace Laravella\CMS;

use \Seeder;
use \DB;

class CMSBackupSeeder extends Seeder {

    private function __backupTable($tableName) {
        $sql = "drop table if exists `_db_bak_$tableName`;";
        echo DB::unprepared($sql) . "\n";
        $sql = "create table `_db_bak_$tableName` as select * from `$tableName`";
        echo DB::unprepared($sql) . "\n";
        
    }
    
    public function run() {
        $this->__backupTable("categories");
        $this->__backupTable("category_content");
        $this->__backupTable("comments");
        $this->__backupTable("contact_types");
        $this->__backupTable("contacts");
        $this->__backupTable("content_media");
        $this->__backupTable("content_types");
        $this->__backupTable("contentmetas");
        $this->__backupTable("contents");
        $this->__backupTable("galleries");
        $this->__backupTable("groups");
        $this->__backupTable("links");
        $this->__backupTable("maps");
        $this->__backupTable("mcollection_media");
        $this->__backupTable("mcollections");
        $this->__backupTable("medias");
        $this->__backupTable("migrations");
        $this->__backupTable("modules");
        $this->__backupTable("product_categories");
        $this->__backupTable("products");
        $this->__backupTable("roles");
        $this->__backupTable("throttle");
        $this->__backupTable("usergroups");
        $this->__backupTable("users");
        $this->__backupTable("users_groups");
    }
}
?>
