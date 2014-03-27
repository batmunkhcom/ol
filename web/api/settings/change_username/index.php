<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
$post_data =  post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $username = $post_data['new_username'];
    
    $check = $cb->get('username::'.$username);
    
    if($check){
        $result['message'] = 'This address is already taken';
    }else{
        $json = $cb->get('user::'.$userid);
        if($json){
            $arr = json_decode($json,true);
            $cb->delete('username::'.$arr['username']);
            $arr['username'] = $username;
            $cb->set('username::'.$username,$userid);
            $cb->set('user::'.$userid, json_encode($arr));
            
            $result['message'] = true;
        }
    }
    
    echo json_encode($result);
    
}
?>
