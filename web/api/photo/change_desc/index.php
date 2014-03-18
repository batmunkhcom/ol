<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $photoid = $post_data['photoid'];
    $description = $post_data['description'];
    
    $photo_json = $cb->get('photos::'.$photoid);
    
    if($photo_json){
        $photo_array = json_decode($photo_json, true);
        if($photo_array['userid']==$userid){
            
            $photo_array['description'] = $description;
            $cb->set('photos::'.$photoid, json_encode($photo_array));
        }
        
    }
    
}
?>
