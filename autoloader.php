<?php
/**
 * Author: Vlad Lyga
 *
 */

function my_autoloader($class_name)
{
    $paths = array(
        'src',
        'tests'
    );

    $filename = $class_name.'.php';

    foreach ($paths as $path) {
        if (file_exists(__DIR__.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename)) {
            include __DIR__.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename;
            break;
        }
    }
}

spl_autoload_register('my_autoloader');