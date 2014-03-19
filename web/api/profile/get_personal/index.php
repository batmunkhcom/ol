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
        $return['result']['political_views'] = $arr['political_views'];
        $return['result']['world_views'] = $arr['world_views'];
        $return['result']['personal_priority'] = $arr['personal_priority'];
        $return['result']['bad_view'] = $arr['bad_view'];
        $return['result']['bad_name'] = $arr['bad_name'];
        
        
    }else{
        $return['message'] = false;
    }
    echo json_encode($return);
}

