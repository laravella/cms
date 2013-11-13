<?php

use Laravella\Crud\Log;
use \Seeder;
use \DB;

/**
 * @deprecated see TablesSeeder.php
 */
class CMSSeedContents extends Seeder {

    private function __addContents($id, $name)
    {
//        $contents = array('id' => $id, 'name' => $name);
//        DB::table('content_types')->insert($contents);
//        Log::write(Log::INFO, $name . ' display types created');
    }

    public function run()
    {
//        $this->__addContents(1, 'page');
    }

}

?>