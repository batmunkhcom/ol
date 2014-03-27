<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend


$post_data = post();
$ognoo = date('Y-m-d H:i:s');

if(count($post_data)>0){
  $userid = $post_data['userid'];
  $group_id = $post_data['group_id'];
  
  
  $json_group = $cb->get('groupmembers::'.$group_id);
  if ($json_group) {
      $groupmember = json_decode($json_group,true);
      $groupmember['request'][$userid]['userid'] = $userid;
      $groupmember['request'][$userid]['created_at'] = $ognoo;
      

    $ret = $cb->set('groupmembers::'.$group_id, json_encode($groupmember));
    if($ret){
        $result['message'] = true;
    }else{
        $result['message'] = false;
    }
  }else{
      $result['message'] = "Error group not found";
  }
  
    
  echo json_encode($result);
  
}
?>
