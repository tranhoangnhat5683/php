<?php
// goes away in a production
error_reporting(E_ALL);

// define BASE_PATH constant
define('BASE_PATH', dirname(dirname(__FILE__)));

// define APPLICATION_PATH constant
define('APPLICATION_PATH', BASE_PATH . '/application');

// set the include path
set_include_path(BASE_PATH
                 . '/../../library'
                 . PATH_SEPARATOR
                 . APPLICATION_PATH
                 . '/../library'
                 . PATH_SEPARATOR
                 . get_include_path());

// autoload classes from the library
function __autoload($class) {
    include str_replace('_', '/', $class) . '.php';
}

// start the session
Zend_Session::start();

// define application environment
define('APPLICATION_ENVIRONMENT', 'development');

// let's go!
$application = new Zend_Application(APPLICATION_ENVIRONMENT,
                                    APPLICATION_PATH . '/configs/application.ini');
try {
    $application->bootstrap();
    $application->run();
} catch (Exception $exception) {
    echo $exception->getMessage();
    exit(1);
}