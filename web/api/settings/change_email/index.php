<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
$post_data =  post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $email = $post_data['new_email'];
    
    $check = $cb->get('useremail::'.$email);
    if($check){
        $result['message'] = 'This email is already taken';
    }else{
        $json = $cb->get('user::'.$userid);
        if($json){
            $return = array();
            $arr = json_decode($json,true);
            $cb->delete('useremail::'.$arr['email']);
            $arr['email'] = $email;
            $cb->set('useremail::'.$email,$userid);
            $cb->set('user::'.$userid, json_encode($arr));
            
            $result['message'] = true;
            

            


        }
        echo $cb->get('user::'.$userid);
//        echo json_encode($result);
    }
    
//    $password = generatePassword($password,$salt);
}
?>
