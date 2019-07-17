<?php
// Load Config
require_once 'config/config.php';
// Load helpers
require_once 'helpers/url_helper.php';

// Autoload Core Libraries & modules(models)
spl_autoload_register(function($className){

    $className = strtolower($className);
    $className = str_replace('__','/',$className);
    $class = APPROOT.'/libraries/'.$className.".php";

//      if(is_file($class))
//      {
//          require_once $class;
//      }

    if(!is_file($class)) {
        $class = APPROOT . '/' . $className . ".php";
    }

    require_once $class;
});
  
