<?php

/*
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$router->respond('GET', '/', function ($request, $response) {

    return 'Backend home<br />';
});

$functions_php = \File::getFiles(DIR_CONFIG . 'routers' . DS, 'php');
foreach ($functions_php as $k => $v) {
    require_once($v);
}

// Run it!
$router->dispatch();
