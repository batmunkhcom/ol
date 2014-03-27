<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend


$post_data = post();
$ognoo = date('Y-m-d H:i:s');

if(count($post_data)>0){
  $userid = $post_data['userid'];
  $group_id = $post_data['group_id'];
  $title = $post_data['name'];
  $username = $post_data['username'];
  $description = $post_data['description'];
  $category = $post_data['category'];
  $website = $post_data['website'];
  
  $json_group = $cb->get('group::'.$group_id);
  if ($json_group) {
      $group = json_decode($json_group,true);
    $group['name'] = $title;
    $group['username'] = $username;
    $group['description'] = $description;
    $group['category'] = $category;
    $group['website'] = $website;

    $ret = $cb->set('group::'.$group_id, json_encode($group));
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
