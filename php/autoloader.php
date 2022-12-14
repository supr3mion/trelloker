<?php

// autoload start

spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {

//    $autoloader_exceptions = array(
//        'MongoDate',
//    );
//
//    if (in_array($className, $autoloader_exceptions)) {
//        return;
//    }
    $path = 'classes/';
    $extension = '.class.php';
    $fullPath = $path . $className . $extension;

    include_once $fullPath;
}

// autoload end
