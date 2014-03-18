<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $albumid = $post_data['albumid'];
    $photoid = $post_data['photoid'];
    
    $album_json = $cb->get('album::'.$albumid);
    
    if($album_json){
        $album_array = json_decode($album_json, true);
        if($album_array['userid']==$userid){
            $album_array['thumbid'] = $photoid;
            $cb->set('album::'.$albumid, json_encode($album_array));
        }
    }
    
}
?>
