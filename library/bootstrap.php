<?php

/*
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('DS', DIRECTORY_SEPARATOR);
define('DIR_ABS', str_replace(basename(__DIR__), '', __DIR__));

//Folder configuration
define('DIR_LIB', DIR_ABS . 'library' . DS);
define('DIR_CORE', DIR_LIB);
define('DIR_CONFIG', DIR_ABS . 'config' . DS);
define('DIR_MODULE', DIR_ABS . 'modules' . DS);
define('DIR_LANG', DIR_ABS . 'lang' . DS);
define('DIR_TMP', DIR_ABS . 'tmp' . DS);
define('DIR_CACHE', DIR_ABS . 'cache' . DS);
define('DIR_LOG', DIR_ABS . 'log' . DS);
define('DIR_DOCS', DIR_ABS . 'docs' . DS);
define('DIR_UPLOAD', 'upload' . DS);

//load config file
require_once(DIR_CONFIG . 'main.php');

//load config file
require_once(DIR_LANG . 'mn/index.php');

//load autoloader
require DIR_LIB . 'vendor/autoload.php';

//require files in function folder.
$functions_php = \File::getFiles(DIR_LIB . 'functions' . DS, 'php');
foreach ($functions_php as $k => $v) {
    require_once($v);
}

$config = new \Config(array());
//router achaallah
$router = new \Klein\Klein();
