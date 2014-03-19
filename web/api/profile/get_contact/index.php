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
        $return['result']['country'] = $arr['country'];
        $return['result']['city'] = $arr['city'];
        $return['result']['district'] = $arr['district'];
        $return['result']['horoo'] = $arr['horoo'];
        $return['result']['mobile'] = $arr['mobile'];
        $return['result']['other_mobile'] = $arr['other_mobile'];
        $return['result']['website'] = $arr['website'];
        $return['result']['twitter_id'] = $arr['twitter_id'];
        $return['result']['facebook_id'] = $arr['facebook_id'];
        $return['result']['horoo_visibility'] = $arr['horoo_visibility'];
        $return['result']['mobile_visibility'] = $arr['mobile_visibility'];
        $return['result']['other_mobile_visibility'] = $arr['other_mobile_visibility'];
        
        
    }else{
        $return['message'] = false;
    }
    echo json_encode($return);
}

