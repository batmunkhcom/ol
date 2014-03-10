<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $pv = $post_data['political_views'];
    $wv = $post_data['world_views'];
    $pp = $post_data['personal_priority'];
    $bad_view = $post_data['bad_view'];
    $bad_name = $post_data['bad_name'];
    $userid = $post_data['userid'];
    
    $json = $cb->get('userprofile::'.$userid);
    
    $arr = json_decode($json,true);
    
    if(count($arr)){
        $arr['political_views'] = $pv;
        $arr['world_views'] = $wv;
        $arr['personal_priority'] = $pp;
        $arr['bad_view'] = $bad_view;
        $arr['bad_name'] = $bad_name;
        
        $cb->set('userprofile::'.$userid, json_encode($arr));
    }
    
    echo $cb->get('userprofile::'.$userid);die();
    
}

