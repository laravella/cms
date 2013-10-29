<?php namespace Laravella\CMS;

use Laravella\Crud\CrudSeeder;

class PostCrudSeeder extends CrudSeeder {
    
    public function run()
    {
        //cms
        setTitle('medias'.'_'.'getselect', 'Media');
        setTitle('contents'.'_'.'getselect', 'Content');
        setTitle('mcollections'.'_'.'getselect', 'Media Collections');
        setTitle('galleries'.'_'.'getselect', 'Galleries');
        setTitle('users'.'_'.'getselect', 'Users');
        setTitle('usergroups'.'_'.'getselect', 'User Groups');
        setTitle('categories'.'_'.'getselect', 'Categories');
    }

}