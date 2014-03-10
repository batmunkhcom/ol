<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $country = $post_data['country'];
    $city = $post_data['city'];
    $district = $post_data['district'];
    $horoo = $post_data['horoo'];
    $mobile = $post_data['mobile'];
    $other_mobile = $post_data['other_mobile'];
    $website = $post_data['website'];
    $twitter_id = $post_data['twitter_id'];
    $facebook_id = $post_data['facebook_id'];
    $userid = $post_data['userid'];
    $mobile_visibility = $post_data['mobile_visibility'];
    $other_mobile_visibility = $post_data['other_mobile_visibility'];
    $horoo_visibility = $post_data['horoo_visibility'];
    
    $profile_json = $cb->get('userprofile::'.$userid);    
    
    if($profile_json){
        
    $profile = json_decode($profile_json,true);
    
        $profile['country'] = $country;
        $profile['city'] = $city;
        $profile['district'] = $district;
        $profile['horoo'] = $horoo;
        $profile['mobile'] = $mobile;
        $profile['other_mobile'] = $other_mobile;
        $profile['website'] = $website;
        $profile['twitter_id'] = $twitter_id;
        $profile['facebook_id'] = $facebook_id;
        $profile['userid'] = $userid;
        $profile['horoo_visibility'] = $horoo_visibility;
        $profile['mobile_visibility'] = $mobile_visibility;
        $profile['other_mobile_visibility'] = $other_mobile_visibility;
        
        $tojson = json_encode($profile);

        $cb->set('userprofile::'.$userid, $tojson);
        
//        echo $cb->get('userprofile::'.$userid);
    }else{
        echo "Error no such userid";
    }
}
