<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
$post_data =  post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $old_password = $post_data['old_password'];
    $new_password = $post_data['new_password'];
    
    $json = $cb->get('user::'.$userid);
    if($json){
        $return = array();
        $arr = json_decode($json,true);
        $salt = $arr['salt'];
        $checkpass = generatePassword($old_password,$salt);
       
        if($checkpass==$arr['password']){
            $g_newpass = generatePassword($new_password, $salt);
            $arr['password'] = $g_newpass;
            $cb->set('user::'.$userid, json_encode($arr));
            $return['message'] = true;
        }else{
            $return['message'] = 'Error pass buruu bna';
            
        }
        
        echo json_encode($return);
        
        
    }
    
//    $password = generatePassword($password,$salt);
}
?>
