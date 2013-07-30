<?php

/**
 * Description of CMSController
 *
 * @author Victor
 */
class CMSController extends BaseController {

    public function getIndex()
    {
        return View::make("cms::cmsview");
    }

    public function missingMethod($parameters = array())
    {
        return "Missing Method";
    }

}

?>
