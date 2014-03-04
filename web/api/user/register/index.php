<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';

?>
<form method="post">
    <input name="email" >
    <input type="submit">
</form>
<?php


$post_data =  post();
if(count($post_data)>0){
    $firstname = $post_data['firstname'];
    $lastname = $post_data['lastname'] ;
    $gender = $post_data['gender'];
    $email = $post_data['email'];
    $phone = $post_data['phone'];
    
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
        exit();
    }
    
    $password = $post_data['$password'];
    $fb_id = intval($post_data['facebook_id']);

    $salt = rand(1111,9999); 
    $password = generatePassword($password,$salt);
    $token = md5($email.rand(1111, 9999));

    if(isset($school)&& count($school)>0){
        $school['country'] = $school['country'];
        $school['city'] = $school['city'];
        $school['school'] = $school['school'];
        $school['year_graduated'] = $school['year_graduated'];
        $school['class'] = $school['class'];
    }

    if(isset($school)&& count($school)>0){
        $college['country'] = $college['country'];
        $college['city'] = $college['city'];
        $college['school'] = $college['school'];
        $college['year_graduated'] = $college['year_graduated'];
        $college['department'] = $college['department'];
        $college['class'] = $college['class'];
    }
    
    $userid = $cb->increment("user::count");
    
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
        echo $userid;
    }    
    
}
echo $cb->get('user::'.$userid);
echo '<Br>mail-'.$cb->get('useremail::'.$email);
echo '<Br>phone-'.$cb->get('userphone::'.$userid);
echo '<Br>fb-'.$cb->get('userpfbid::'.$userid);
echo '<Br>username-'.$cb->get('username::profile'.$userid);
//$cb->set("user::count", 0);
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
