<?php

/*
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//user route
$router->with('/user', function () use ($router) {

    //settings home
    $router->respond('GET', '/?', function ($request, $response) {
        \Config::set('load_file', '');
    });

    //settings save
    $router->respond('POST', '/save', function ($request, $response, $service) {

    });

    //comment update
    $router->respond('GET', '/profile/[i:id]', function ($request, $response) {

        set_get_parameter('id', $request->id);

        \Config::set('load_file', DIR_MODULE . 'user' . DS . 'profile.php');
    });
});
