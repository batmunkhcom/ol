<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend


$post_data = post();
$ognoo = date('Y-m-d H:i:s');
if(count($post_data)>0){
    /* @var $from nziin huselt yawuulj bui id */
    $from = $post_data['fromid'];
    /* @var $from //huselt huleej bgaa id */
    $to = $post_data['toid'];
    
    
    $from_json = $cb->get('userfriend::'.$from);
    if($from_json){
        $from_array = json_decode($from_json,true);
        if(isset($from_array['myrequest'][$to]) || isset($from_array['friendids'][$to]) ){
            echo "Error requist yawuulsan or nzuud";
        }else{
            $from_array['myrequest'][$to]['userid'] = $to;
            $from_array['myrequest'][$to]['created_at'] = $ognoo;
            
            $cb->set('userfriend::'.$from, json_encode($from_array));
        }
    }else{
        $friend = array();
        $friend['jsonType'] = "userfriend";
        $friend['userid'] = $from;
        $friend['request'] = array();
        $friend['friendids'] = array();
        $friend['myrequest'] = array();
        $friend['followers'] = array();
        $friend['ifollow'] = array();
        
        $friend['myrequest'][$to]['userid'] = $to;
        $friend['myrequest'][$to]['created_at'] = $ognoo;
        
        $cb->set('userfriend::'.$from, json_encode($friend));
        
    }
    
    $to_json = $cb->get('userfriend::'.$to);
    if($to_json){
        $to_array = json_decode($to_json,true);
        if(isset($to_array['request'][$from]) || isset( $to_array['friendids'][$from]) ){
            echo "Error requist yawuulsan or nzuud";
        }else{
            $to_array['request'][$from]['userid'] = $from;
            $to_array['request'][$from]['created_at'] = $ognoo;
            $cb->set('userfriend::'.$to, json_encode($to_array));
        }
        
    }else{
        $friend_to = array();
        $friend_to['jsonType'] = "userfriend";
        $friend_to['userid'] = $to;
        $friend_to['request'] = array();
        $friend_to['friendids'] = array();
        $friend_to['myrequest'] = array();
        $friend_to['followers'] = array();
        $friend_to['ifollow'] = array();
        
        $friend_to['request'][$from]['userid'] = $from;
        $friend_to['request'][$from]['created_at'] = $ognoo;
        $cb->set('userfriend::'.$to, json_encode($friend_to));
        
    }
    
    
    
    
}
?>
