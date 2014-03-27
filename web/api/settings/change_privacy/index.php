<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
$post_data =  post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $json_settings = $cb->get('usersettings::'.$userid);
    if($json_settings){
        $arr = json_decode($json_settings, true);
        $var = intval($post_data['var']);
        $val = $post_data['val'];
        $result['message'] = true;
        switch ($var) {
            case "left_friend ":
                $arr['left_friend'] = $val;
              break;
              case "left_photo ":
                $arr['left_photo'] = $val;
              break;
              case "left_video ":
                $arr['left_video'] = $val;
              break;
              case "left_music ":
                $arr['left_music'] = $val;
              break;
              case "left_message ":
                $arr['left_message'] = $val;
              break;
              case "left_group ":
                $arr['left_group'] = $val;
              break;
              case "left_bookmark ":
                $arr['left_bookmark'] = $val;
              break;
              case "left_apps ":
                $arr['left_apps'] = $val;
              break;
              case "wall_only_my_post ":
                $arr['wall_only_my_post'] = $val;
              break;
              case "post_disable_comment ":
                $arr['post_disable_comment'] = $val;
              break;
              case "profile_view ":
                $arr['profile_view'] = $val;
              break;
              case "photo_view ":
                $arr['photo_view'] = $val;
              break;
              case "video_view ":
                $arr['video_view'] = $val;
              break;
              case "group_view ":
                $arr['group_view'] = $val;
              break;
              case "music_view ":
                $arr['music_view'] = $val;
              break;
              case "gift_view ":
                $arr['gift_view'] = $val;
              break;
              case "map_view ":
                $arr['map_view'] = $val;
              break;
              case "friend_view ":
                $arr['friend_view'] = $val;
              break;
              case "profile_write ":
                $arr['profile_write'] = $val;
              break;
              case "comment_view ":
                $arr['comment_view'] = $val;
              break;
              case "comment_write ":
                $arr['comment_write'] = $val;
              break;
              case "mail_send ":
                $arr['mail_send'] = $val;
              break;
              case "invite_group ":
                $arr['invite_group'] = $val;
              break;
              case "invite_app ":
                $arr['invite_app'] = $val;
              break;
              case "add_friend ":
                $arr['add_friend'] = $val;
              break;
              case "internet_view ":
                $arr['internet_view'] = $val;
              break;

            default:
                $result['message'] = false;
                break;
        }
        
        $cb->set('usersettings::'.$userid, json_encode($arr));
        
        echo json_encode($result);
    }
    
    
    
    

    
//    $password = generatePassword($password,$salt);
}
?>
