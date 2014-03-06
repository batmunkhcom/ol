<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
$post_data =  post();
if(count($post_data)>0){
    if (isset($post_data['email'])) {
        $activate = $post_data['email'];
    }
    
    if (isset($post_data['phone'])) {
        $activate = $post_data['phone'];
    }
    
    $code = $post_data['code'];
    
    $check = $cb->get('activation::'.$activate);
    
    $check_array = json_decode($check,true);
    
    if($check_array['code']==$code){
        echo 'true';
    }else{
        echo 'false';
    }

    
    
    
}
?>
