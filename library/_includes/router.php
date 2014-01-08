<?php

$router->respond('GET', '/', function ($request, $response) {

    return 'Backend home';
    });

\File::getAndIncludePHPFiles(DIR_CONFIG.'routers'.DS);


// Run it!
$router->dispatch();