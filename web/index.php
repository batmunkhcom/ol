<?php

define('APPMODE', 'dev');

require_once '../core/bootstrap.php';

$router = new \Klein\Klein();

//user route
$router->with('/user', function () use ($router) {

    //settings home
    $router->respond('GET', '/?', function ($request, $response) {

    });

    //settings save
    $router->respond('POST', '/save', function ($request, $response, $service) {

        //form invalid bol
        if (!comment_form(post('form_name'), post('code'))) {
            //umnuh huudas ruu shidne
            $service->back();
        } else {
            echo 'valid form';
        }
    });

    //comment update
    $router->respond('GET', '/edit/[i:id]', function ($request, $response) {

        set_get_parameter('id', $request->id);
    });
});


// Run it!
$router->dispatch();

