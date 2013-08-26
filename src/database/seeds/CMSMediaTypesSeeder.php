<?php

use Laravella\Crud\Log;
use \Seeder;
use \DB;

/**
 * @deprecated see TablesSeeder.php
 */
class CMSSeedMediaTypes extends Seeder {

    private function __addContentType($id, $name)
    {
        $displayTypes = array('id' => $id, 'name' => $name);
        DB::table('media_types')->insert($displayTypes);
        Log::write(Log::INFO, $name . ' display types created');
    }

    public function run()
    {
        DB::table('media_types')->delete();

        $this->__addContentType('document', 'document');
        $this->__addContentType('file', 'file');
        $this->__addContentType('image', 'image');
    }

}

?>