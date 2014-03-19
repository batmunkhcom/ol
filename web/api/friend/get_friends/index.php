<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//get album photo
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $return = array();
    
    $friend = $cb->get('userfriend::'.$userid);
    if($friend){
        $fr_arr = json_decode($friend,true);



        foreach($fr_arr['friendids'] as $id => $friends) {
            $user_json = $cb->get('userprofile::'.$friends['userid']);
            $user = json_decode($user_json, true);
            $return[$friends['userid']]['name'] = $user['last_name'].' '.$user['first_name'];

    //        echo $fr_arr['friendids'][$id][];
        }
    }
    echo json_encode($return);
    
}



?>
