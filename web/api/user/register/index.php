<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//register
require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $firstname = $post_data['firstname'];
    $lastname = $post_data['lastname'] ;
    $gender = $post_data['gender'];
    $email = $post_data['email'];
    $phone = $post_data['phone'];
    $password = $post_data['password'];
    $fb_id = intval($post_data['facebook_id']);
    
    $check_email = $cb->get('useremail::'.$email);
    $check_phone = $cb->get('userphone::'.$phone);
    $check_fb = $cb->get('userpfbid::'.$fb_id);
    
    $salt = rand(1111,9999); 
    $password = generatePassword($password,$salt);
    $token = md5($email.rand(1111, 9999));
    
    if($check_email || $check_phone || $check_fb){
        echo "Error burtguulsen mail hayag";
        return false;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "not valid email";
        return false;
        exit();
    }
    
    

    
    
    
    
    
    $userid = $cb->increment("user::count");
    
    if(isset($post_data['school'])&& count($post_data['school'])>0){
        $school['userid'] = $userid;
        $school['schoolid'] = $cb->increment('school::count');
        $school['jsonType'] = 'school';
        $school['country'] = $post_data['school']['country'];
        $school['city'] = $post_data['school']['city'];
        $school['school'] = $post_data['school']['school'];
        $school['year_graduated'] = $post_data['school']['year_graduated'];
        $school['district'] = $post_data['school']['district'];
    }

    if(isset($post_data['college'])&& count($post_data['college'])>0){
        $college['userid'] = $userid;
        $college['collegeid'] = $cb->increment('college::count');
        $college['jsonType'] = 'college';
        $college['country'] = $post_data['college']['country'];
        $college['city'] = $post_data['college']['city'];
        $college['school'] = $post_data['college']['school'];
        $college['year_graduated'] = $post_data['college']['year_graduated'];
        $college['department'] = $post_data['college']['department'];
        $college['class'] = $post_data['college']['class'];
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
        $cb->set('userprofile::'.$userid,'{"userid":'.$userid.', "jsonType":"userprofile"}');
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
            $school_id = $cb->increment('school::count');
            $cb->set('school::'.$school_id,$school_json);
        }
        
        if(count($college)>0){
            $college_json = json_encode($college);
            $college_id = $cb->increment('college::count');
            $cb->set('college::'.$college_id,$college_json);
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
