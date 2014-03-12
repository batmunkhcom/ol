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
    
    $new_id = $cb->increment('album::count');
    
    $album = array();
    $album['jsonType'] = 'album';
    $album['userid'] = $userid;
    $album['albumid'] = $new_id;
    $album['title'] = $title;
    $album['description'] = $description;
    $album['permission'] = $permission;
    
    $cb->set('album::'.$new_id, json_encode($album));
    
    
}
?>
