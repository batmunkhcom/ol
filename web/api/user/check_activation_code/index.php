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
    
    
    
    
    

    
    
    
}
?>
