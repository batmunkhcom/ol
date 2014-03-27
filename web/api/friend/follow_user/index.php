<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//follow user
$post_data = post();
if(count($post_data)>0){
    $from = $post_data['fromid'];// dagaj bgaa hunii id
    $to = $post_data['toid']; // daguulj bui hunii id
    $ognoo = date('Y-m-d H:i:s');
//    
    $from_json = $cb->get('userfriend::'.$from);
//    echo $from_json;die();
    if($from_json){
        $from_array = json_decode($from_json,true);
        if(isset($from_array['ifollow'][$to])){
            unset($from_array['ifollow'][$to]);
        }else{
            $from_array['ifollow'][$to]['userid'] = $to;
            $from_array['ifollow'][$to]['created_at'] = $ognoo; 
        }
        
        $cb->set('userfriend::'.$from, json_encode($from_array));
        
    }
//    
    $to_json = $cb->get('userfriend::'.$to);
    if($to_json){
        $to_array = json_decode($to_json,true);
        
        if(isset($to_array['followers'][$from])){
            unset($to_array['followers'][$from]);
        }else{
            $to_array['followers'][$from]['userid'] = $from;
            $to_array['followers'][$from]['created_at'] = $ognoo;
        }
        
        $cb->set('userfriend::'.$to, json_encode($to_array));
    }
//    
//    echo $cb->get('userfriend::'.$from);
   
    
}
?>
