<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
$post_data =  post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $phone = $post_data['new_phone'];
    
    $check = $cb->get('userphone::'.$phone);
    if($check){
        $result['message'] = 'This phone is already taken';
    }else{
        $json = $cb->get('user::'.$userid);
        if($json){
            $return = array();
            $arr = json_decode($json,true);
            $cb->delete('userphone::'.$arr['phone']);
            $arr['phone'] = $phone;
            $cb->set('userphone::'.$phone,$userid);
            $cb->set('user::'.$userid, json_encode($arr));
            
            $result['message'] = true;
            
        }
        echo $cb->get('user::'.$userid);
//        echo json_encode($result);
    }
    
//    $password = generatePassword($password,$salt);
}
?>
