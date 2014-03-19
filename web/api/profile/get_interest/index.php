<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $return = array();
    $json = $cb->get('userprofile::'.$userid);
    if($json){
        $arr = json_decode($json, true);
        $return['message'] = true;
        $return['result']['interest'] = $arr['interest'];
        
        
        
    }else{
        $return['message'] = false;
    }
    echo json_encode($return);
}

