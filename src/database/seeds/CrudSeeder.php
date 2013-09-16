<?php namespace Laravella\CMS;

use Laravella\Crud\CrudSeeder;

class CrudSeeder extends CrudSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            //set medias.id to thumbnail
            $mediaId = $this->getId('_db_fields', 'fullname', 'medias.id');
            $displayTypeId = $this->getId('_db_display_types', 'name', 'widget');
            $widgetTypeId = $this->getId('_db_widget_types', 'name', 'thumbnail');
            $this->updateOrInsert('_db_fields', array('id'=>$mediaId), 
                    array('display_type_id'=>$displayTypeId, 'widgetTypeId'=>$widgetTypeId));
            
            //set contents.content to ckeditor
            $contentId = $this->getId('_db_fields', 'fullname', 'contents.content');
            $widgetTypeId = $this->getId('_db_widget_types', 'name', 'ckeditor');
            $this->updateOrInsert('_db_fields', array('id'=>$contentId), 
                    array('display_type_id'=>$displayTypeId, 'widgetTypeId'=>$widgetTypeId));
	}

}