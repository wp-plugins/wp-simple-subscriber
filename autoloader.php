<?php

/**
 *
 * PSR-0 Autoloader
 *
**/

// Prevent direct unless 'ajaxrequest' is set.
if(!empty($_SERVER['SCRIPT_FILENAME']) && basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']) && !isset($_REQUEST['ajaxrequest'])){
    die('Sorry. This file cannot be loaded directly.');
}

// PSR-0 Autoloader
class WPSS_Autoloader{

    /**
     *
     * loader
     *
     * @access public
     * @param null
     * @return null
     * @since 1.0.0
     * @version 1.0.0
    **/
    static public function loader($class){
        // Get software.
        $software = strtolower($_SERVER['SERVER_SOFTWARE']);
        // Check namespace.
        if(strpos($class, 'WPSS\\') === false) return;
        // Set file name.
        $file_name = str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class) . '.php');
        // Include file.
        if(strpos($software, 'microsoft-iis') !== false){
            // This is an IIS server so fix paths.
            include(str_replace('wpss\\', '', $file_name));
        }
        else{
            // This is probably an Apache / Nginx server.
            include(str_replace('wpss/', '', $file_name));
        }
    }
}

spl_autoload_register('WPSS_Autoloader::loader');
