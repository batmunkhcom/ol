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
    
    $a_code = rand(11111,99999); 
    $a_array = array();
    $a_array['jsonType'] = 'activation';
    $a_array['email'] = $activate;
    $a_array['code'] = $a_code;
    
    $a_json = json_encode($a_array);
    
    $cb->set('activation::'.$activate, $a_json);
    
    //email bolon utasruu code ilgeeh heseg end bichigdene

    
    
    
}
?>
