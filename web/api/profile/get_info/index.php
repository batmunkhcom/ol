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
        $return['result']['family_name'] = $arr['family_name'];
        $return['result']['last_name'] = $arr['last_name'];
        $return['result']['first_name'] = $arr['first_name'];
        $return['result']['gender'] = $arr['gender'];
        $return['result']['relationship_status'] = $arr['relationship_status'];
        $return['result']['relationship_status_visibility'] = $arr['relationship_status_visibility'];
        $return['result']['bday_year'] = $arr['bday_year'];
        $return['result']['bday_month'] = $arr['bday_month'];
        $return['result']['bday_day'] = $arr['bday_day'];
        $return['result']['bday_visibility'] = $arr['bday_visibility'];
        $return['result']['born'] = $arr['born'];
        $return['result']['language'] = $arr['language'];
        
        
    }else{
        $return['message'] = false;
    }
    echo json_encode($return);
}

