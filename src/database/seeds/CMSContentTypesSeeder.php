<?php

use Laravella\Crud\Log;
use \Seeder;
use \DB;

/**
 * @deprecated see TablesSeeder.php
 */
class CMSSeedContentTypes extends Seeder {

    private function __addContentType($id, $name)
    {
        $displayTypes = array('id' => $id, 'name' => $name);
        DB::table('content_types')->insert($displayTypes);
        Log::write(Log::INFO, $name . ' display types created');
    }

    public function run()
    {
        DB::table('content_types')->delete();

        $this->__addContentType(1, 'page');
        $this->__addContentType(2, 'post');
        $this->__addContentType(3, 'comment');
    }

}

?>