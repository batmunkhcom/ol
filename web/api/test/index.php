<?php
require '../../../global/db.php';
require '../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    echo json_encode($post_data);
}