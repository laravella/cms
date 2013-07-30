<?php

use Laravella\Crud\Log;

class CMSInstallController extends Controller {

    protected $layout = 'crud::layouts.default';

    /**
     * The root of the crud application /db
     * 
     * @return type
     */
    public function getIndex()
    {
        return View::make("crud::cmsinstall", array('action' => 'index'));
    }

    /**
     * Drop metadata tables and redo an install
     */
    public function getReinstall()
    {

        set_time_limit(360);

        foreach (CMSInstallController::__getAdminTableClasses(true) as $adminTableClass)
        {
            $atc = new $adminTableClass();
            $atc->down();
            Log::write("success", "dropped table $adminTableClass");
        }

        return $this->getInstall();
    }

    /**
     * returns an array with a list of tables that are used for admin purposes
     * 
     * @param type $dropSafe Set dropSafe = true if tables should be returned in an order that is safe to drop them 
     * @return type String[]
     */
    private static function __getAdminTableClasses($dropSafe = false)
    {
        if (!$dropSafe)
        {   //order in which to create tables
            return array(
                "CreateMenusTable",
                "CreateLogsTable",
                //"CreateUsergroupsTable",
                //"CreateUsersTable",
                "CreateSeveritiesTable",
                "CreateAuditTable",
                "CreateTablesTable",
                "CreateFieldsTable",
                "CreateViewsTable",
                "CreateActionsTable",
                "CreateTableActionViewsTable",
                "CreateUserPermissionsTable",
                "CreateUserGroupPermissionsTable",
                //Sentry
                "CreateSentryThrottle",
                "CreateUsergroupsTable",
                "CreateSentryGroups",
                "CreateSentryUsers",
                "CreateSentryUsersGroupsPivot");
        }
        else
        {   //order in which to drop tables
            return array(
                "CreateMenusTable",
                "CreateLogsTable",
                "CreateSeveritiesTable",
                "CreateAuditTable",
                "CreateTableActionViewsTable",
                "CreateUserPermissionsTable",
                "CreateUserGroupPermissionsTable",
                "CreateFieldsTable",
                "CreateViewsTable",
                "CreateActionsTable",
                "CreateTablesTable",
//                "CreateUsersTable",
//                "CreateUsergroupsTable",
                //Sentry
                "CreateSentryThrottle",
                "CreateUsergroupsTable",
                "CreateSentryGroups",
                "CreateSentryUsers",
                "CreateSentryUsersGroupsPivot");
        }
    }

    /**
     * Generate metadata from the database and insert it into _db_tables
     * 
     * @param type $table
     * @return type
     */
    public function getInstall()
    {
        try
        {
            set_time_limit(360);
//create all the tables
            foreach (CMSInstallController::__getAdminTableClasses() as $adminTableClass)
            {
                $atc = new $adminTableClass();
                $atc->up();
            }

//            $dbSeeder = new DatabaseSeeder();
//            $dbSeeder->run();

            Log::write("success", "Installation completed successfully.");
        }
        catch (Exception $e)
        {
            Log::write("important", $e->getMessage());
            $message = " x Error during installation.";
            Log::write("important", $message);
//throw new Exception($message, 1, $e);
        }
        //$totalLog = array_merge($domain->getLog(), $this->log);
        return View::make("cms::cmsinstall", array('action' => 'install', 'log' => array()));
    }

    /**
     * If method is not found
     * 
     * @param type $parameters
     * @return string
     */
    public function missingMethod($parameters)
    {
        return "missing";
    }

}

?>