<?php

/*
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//test route
$router->with('/test', function () use ($router) {


    //test test
    $router->respond('GET', '/test', function ($request, $response) {

        \Config::set('load_file', DIR_MODULE . 'test' . DS . 'test.php');
    });

    //test result
    $router->respond('PUT', '/result', function ($request, $response) {

        \Config::set('load_file', DIR_MODULE . 'test' . DS . 'result.php');
    });
});
