<?php

define('APPMODE', 'dev');

require_once '../core/bootstrap.php';
require_once DIR_LIB.'_includes'.DS.'router.php';

if(file_exists(\Config::get('load_file'))){
    require_once \Config::get('load_file').'.php';
}else{
    echo __('No such command found');
}
require_once DIR_LIB.'_includes/footer.php';

