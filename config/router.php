<?php


//user route
$router->with('/user', function () use ($router) {

    //settings home
    $router->respond('GET', '/?', function ($request, $response) {
        \Config::set('load_file','');
    });

    //settings save
    $router->respond('POST', '/save', function ($request, $response, $service) {

    });

    //comment update
    $router->respond('GET', '/profile/[i:id]', function ($request, $response) {

        set_get_parameter('id', $request->id);
        \Config::set('load_file',DIR_MODULE.'user'.DS.'profile.php');
    });
});


// Run it!
$router->dispatch();