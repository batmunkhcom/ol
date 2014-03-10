<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $from = $post_data['fromid'];//zowsooroh id
    $to = $post_data['toid']; // urid ni nziin huselt yawuulsan id
    $type = $post_data['type'];
    
    $from_json = $cb->get('userfriend::'.$from);
    if($from_json){
        $from_array = json_decode($from_json,true);
        if($type=='follow'){
//            ifollow
            if(!in_array($to, $from_array['ifollow'])){
                array_push($from_array['ifollow'], $to);
            }
        }else{
            
        }
        if(in_array($to, $from_array['myrequest']) || in_array($to, $from_array['friendids']) ){
            echo "Aldaa nzuud esvel nziin huselt yawuulsan";
        }else{
            if(in_array($to, $from_array['request'])){
                array_push($from_array['friendids'], $to);
                if(($key = array_search($to, $from_array['request'])) !== false) {
                    unset($from_array['request'][$key]);
                }
                $cb->set('userfriend::'.$from,  json_encode($from_array));
                
            }else{
                "Error urid ni nziin huselt yawuulaagui bna";
            }
        }
    }
    
    $to_json = $cb->get('userfriend::'.$to);
    if($to_json){
        $to_array = json_decode($to_json,true);
        if(in_array($from, $to_array['request']) || in_array($from, $to_array['friendids']) ){
            echo "Aldaa nzuud esvel nziin huselt yawuulsan";
        }else{
            if(in_array($from, $to_array['myrequest'])){
                array_push($to_array['friendids'], $from);
                if(($key = array_search($from, $to_array['myrequest'])) !== false) {
                    unset($to_array['myrequest'][$key]);
                }
                
                $cb->set('userfriend::'.$to,  json_encode($to_array));
            }
        }
        
    }
    
    echo $cb->get('userfriend::'.$from);
    echo "<br>";
    echo $cb->get('userfriend::'.$to);
    
}
?>
