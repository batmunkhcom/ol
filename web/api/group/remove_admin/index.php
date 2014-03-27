<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  


$post_data = post();
$ognoo = date('Y-m-d H:i:s');

if(count($post_data)>0){
  $userid = $post_data['userid'];
  $group_id = $post_data['group_id'];
  $removeby = $post_data['removeby'];
  
  
  $json_group = $cb->get('groupmembers::'.$group_id);
  if ($json_group) {
      $groupmember = json_decode($json_group,true);
      
      if (isset($groupmember['member'][$userid])  && ($groupmember['member'][$removeby]['type']=='admin' || $groupmember['member'][$removeby]['type']=='created' ) ) {
            $groupmember['member'][$userid]['userid'] = $userid;
            $groupmember['member'][$userid]['type'] = 'member';
      }
      
      
      
      
      

    $ret = $cb->set('groupmembers::'.$group_id, json_encode($groupmember));
    if($ret){
        $result['message'] = true;
    }else{
        $result['message'] = false;
    }
  }else{
      $result['message'] = "Error group not found";
  }
  
  echo $cb->get('groupmembers::'.$group_id);
//  echo json_encode($result);
  
}
?>
