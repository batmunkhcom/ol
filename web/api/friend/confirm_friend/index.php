<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $from = $post_data['fromid'];//zowsooroh id
    $to = $post_data['toid']; // urid ni nziin huselt yawuulsan id
    
    $ognoo = date('Y-m-d H:i:s');
    
    $from_json = $cb->get('userfriend::'.$from);
    if($from_json){
        $from_array = json_decode($from_json,true);
        if(isset($from_array['myrequest'][$to]) || isset($from_array['friendids'][$to]) ){
            echo "Aldaa nzuud esvel nziin huselt yawuulsan";
        }else{
            if(isset($from_array['request'][$to])){
                
                $from_array['friendids'][$to]['userid'] = $to;
                $from_array['friendids'][$to]['created_at'] = $ognoo;
                
                unset($from_array['request'][$to]);
                
                $cb->set('userfriend::'.$from,  json_encode($from_array));
                
            }else{
                "Error urid ni nziin huselt yawuulaagui bna";
            }
        }
    }
    
    $to_json = $cb->get('userfriend::'.$to);
    if($to_json){
        $to_array = json_decode($to_json,true);
        if(isset($to_array['request'][$from]) || isset($to_array['friendids'][$from]) ){
            echo "Aldaa nzuud esvel nziin huselt yawuulsan";
        }else{
            if(isset($to_array['myrequest'][$from])){
                
                
                $to_array['friendids'][$to]['userid'] = $from;
                $to_array['friendids'][$to]['created_at'] = $ognoo;
                
                unset($to_array['myrequest'][$from]);
                
                $cb->set('userfriend::'.$to,  json_encode($to_array));
            }
        }
        
    }
    
}
?>
