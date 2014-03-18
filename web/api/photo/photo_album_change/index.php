<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $albumid = $post_data['albumid'];
    $photoid = $post_data['photoid'];
    
    $photo_json = $cb->get('photos::'.$photoid);
    
    if($photo_json){
        $photo_array = json_decode($photo_json, true);
        if($photo_array['userid']==$userid){
            
            
            $chekc_album = $cb->get('album::'.$photo_array['albumid']);
            $chekc_album_array = json_decode($chekc_album,true);
            if($chekc_album_array['thumbid']==$photo_array['photoid']){
                unset($chekc_album_array['thumbid']);     
                $cb->set('album::'.$photo_array['albumid'],  json_encode($chekc_album_array));
            }
            $photo_array['albumid'] = $albumid;
            $cb->set('photos::'.$photoid, json_encode($photo_array));
            
        }
        
    }
    
}
?>
