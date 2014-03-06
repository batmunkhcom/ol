<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $firstname = $post_data['firstname'];
    $lastname = $post_data['lastname'] ;
    $gender = $post_data['gender'];
    $email = $post_data['email'];
    $phone = $post_data['phone'];
    $password = $post_data['$password'];
    $fb_id = intval($post_data['facebook_id']);
    
    $check_email = $cb->get('useremail::'.$email);
    $check_phone = $cb->get('userphone::'.$phone);
    $check_fb = $cb->get('userpfbid::'.$fb_id);
    
    
    if($check_email || $check_phone || $check_fb){
        echo "Error burtguulsen mail hayag";
        return false;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "not valid email";
        return false;
        exit();
    }
    
    

    $salt = rand(1111,9999); 
    $password = generatePassword($password,$salt);
    $token = md5($email.rand(1111, 9999));

    
    
    $userid = $cb->increment("user::count");
    
    if(isset($school)&& count($school)>0){
        $school['userid'] = $userid;
        $school['jsonType'] = 'school';
        $school['schools'][]['country'] = $school['country'];
        $school['schools'][]['city'] = $school['city'];
        $school['schools'][]['school'] = $school['school'];
        $school['schools'][]['year_graduated'] = $school['year_graduated'];
        $school['schools'][]['district'] = $school['district'];
    }

    if(isset($college)&& count($college)>0){
        $college['userid'] = $userid;
        $college['jsonType'] = 'college';
        $college['schools'][]['country'] = $college['country'];
        $college['schools'][]['city'] = $college['city'];
        $college['schools'][]['school'] = $college['school'];
        $college['schools'][]['year_graduated'] = $college['year_graduated'];
        $college['schools'][]['department'] = $college['department'];
        $college['schools'][]['class'] = $college['class'];
    }
    
    $user_array = array();
    $user_array['jsonType'] = "user";
    $user_array['userid'] = $userid;
    $user_array['token'] = $token;
    $user_array['username'] = 'profile'.$userid;
    $user_array['name']['firstname'] = $firstname;
    $user_array['name']['lastname'] = $lastname;
    $user_array['type'] = 1;
    $user_array['email'] = $email;
    $user_array['password'] = $password;
    $user_array['salt'] = $salt;
    $user_array['hash_function'] = 'md5';
    $user_array['phone'] = $phone;
    $user_array['f_id'] = $fb_id;
    $user_array['created_at'] = date("Y-m-d H:i:s");
    
    $user_json = json_encode($user_array);
    
    $result = $cb->set('user::'.$userid, $user_json);
    if($result){
        if (isset($post_data['email'])){
            $cb->set('useremail::'.$email, $userid);
        }
        if (isset($post_data['phone'])) {
            $cb->set('userphone::'.$phone, $userid);
        }
        $cb->set('username::profile'.$userid, $userid); //$cb->get('username::bayarsaikhan'); result:userid
        if(isset($post_data['fid'])){
            $cb->set('userpfbid::'.$fb_id, $userid);
        }
        
        if(count($school)>0){
            $school_json = json_encode($school);
            $cb->set('school::'.$userid,$school_json);
        }
        
        if(count($college)>0){
            $college_json = json_encode($college);
            $cb->set('college::'.$userid,$college_json);
        }
        
        echo $userid;
    }    
    
}

/*
 * user::334{
  "jsonType": "user",
   "userid": "334",
   "token": "46da87fbd78a1210f943970580647e45",
   "username": "profile334",
   "name": {
       "firstname": "Батбаясгалан",
       "lastname": "Алтанцог"
   },
   "type": 1,
   "email": "bayasaa_imp@yahoo.com",
   "phone": "",
   "password": "326649eaac513d9ff20166b4709726c4",
   "f_id": "",
   "salt": "4985",
   "hash_function": "md5",
   "created_at": null,
   "confirmed_at": null
}

 */
