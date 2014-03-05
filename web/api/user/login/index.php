<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
$post_data =  post();
if(count($post_data)>0){
    $email = $post_data['email'];
    $password = $post_data['$password'];
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $userid = $cb->get('useremail::'.$email);
    }else{
        $userid = $cb->get('userphone::'.$email);
    }
    
    if($userid){
        $userjson = $cb->get('user::'.$userid);
        $user = json_decode($userjson,true);
        $password = generatePassword($password, $user['salt']);
        if($password==$user['password']){
            echo $user['userid'];
        }
        
    }else{
        echo "Error: not valid username";
    }
}

?>
