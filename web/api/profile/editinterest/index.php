<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $interest = $post_data['interest'];
    $userid = $post_data['userid'];
    $profile_json = $cb->get('userprofile::'.$userid);    
    
    if($profile_json){
        
    $profile = json_decode($profile_json,true);
    
        $profile['interest'] = $interest;
        
        
        $tojson = json_encode($profile);

        $cb->set('userprofile::'.$userid, $tojson);
        
        echo $cb->get('userprofile::'.$userid);
    }else{
        echo "Error no such userid";
    }
}
