<?php namespace Laravella\CMS\Facades;

/**
 * Description of Db
 *
 * @author Victor
 */

use Illuminate\Support\Facades\Facade;

class CMSGopher extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cmsgopher';
    }

}

?>
