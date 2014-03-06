<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//edit info
require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    
    $family_name = $post_data['family_name'];
    $last_name = $post_data['last_name']; 
    $first_name = $post_data['first_name']; 
    $gender = $post_data['gender'];
    $relationship_status = $post_data['relationship_status']; 
    $relationship_status_visibility = $post_data['relationship_status_visibility'];
    $bday_year = $post_data['bday_year'];
    $bday_month = $post_data['bday_month'];
    $bday_day = $post_data['bday_day'];
    $bday_visibility = $post_data['bday_visibility'];
    $born = $post_data['born'];
    $language = $post_data['language'];
    $userid = $post_data['userid'];
    
        
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
