<?php

/*
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('DS', DIRECTORY_SEPARATOR);
define('DIR_ABS', __DIR__ . DS . '../');

//Folder configuration
define('DIR_LIB', DIR_ABS.'library' . DS);
define('DIR_CONFIG', DIR_ABS.'config' . DS);
define('DIR_TMP', DIR_CORE . 'tmp' . DS);
define('DIR_CACHE', DIR_CORE . 'cache' . DS);
define('DIR_LOG', DIR_CORE . 'log' . DS);
define('DIR_DOCS', DIR_ABS . 'docs' . DS);
define('DIR_UPLOAD', 'upload' . DS);


//load autoloader
require DIR_LIB . 'library/vendor/autoload.php';