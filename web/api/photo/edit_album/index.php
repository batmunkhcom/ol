<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $title = $post_data['title'];
    $description = $post_data['description'];
    $permission = $post_data['permission'];
    $albumid = $post_data['albumid'];
    
    $json = $cb->get('album::'.$albumid);
    if($json){
        $arr = json_decode($json,true);
        $arr['title'] = $title;
        $arr['description'] = $description;
        $arr['permission'] = $permission;
        $cb->set('album::'.$albumid, json_encode($arr));
        
    }
    
    
    
    
    
}
?>
