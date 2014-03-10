<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    /* @var $from nziin huselt yawuulj bui id */
    $from = $post_data['fromid'];
    /* @var $from //huselt huleej bgaa id */
    $to = $post_data['toid'];
    

    $from_json = $cb->get('userfriend::'.$from);
    if($from_json){
        $from_array = json_decode($from_json,true);
        if(in_array($to, $from_array['myrequest']) || in_array($to, $from_array['friendids']) ){
            echo "Error requist yawuulsan or nzuud";
        }else{
            array_push($from_array['myrequest'], $to);
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
        
        array_push($friend['myrequest'],$to);
        
        $cb->set('userfriend::'.$from, json_encode($friend));
        
    }
    
    $to_json = $cb->get('userfriend::'.$to);
    if($to_json){
        $to_array = json_decode($to_json,true);
        if(in_array($from, $to_array['request']) || in_array($from, $to_array['friendids']) ){
            echo "Error requist yawuulsan or nzuud";
        }else{
            array_push($to_array['request'], $from);
            $cb->set('userfriend::'.$to, json_encode($friend_to));
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
        
        array_push($friend_to['request'], $from);
        $cb->set('userfriend::'.$to, json_encode($friend_to));
        
    }
    
}
?>
