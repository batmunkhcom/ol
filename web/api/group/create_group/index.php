<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend


$post_data = post();
$ognoo = date('Y-m-d H:i:s');

//$cb->set('group::count',0);
//echo $cb->increment('group::count');

if(count($post_data)>0){
  $userid = $post_data['userid'];
  $title = $post_data['name'];
  $privacy = $post_data['privacy'];
  $new_id = $cb->increment('group::count');
  
  $group['jsonType'] = 'group';
  $group['groupid'] = $new_id;
  $group['name'] = $title;
  $group['description'] = '';
  $group['privacy'] = $privacy;
  $group['created_at'] = $ognoo;
  $group['created_by'] = $userid;
  $group['username'] = 'group'.$new_id;
  
  $ret = $cb->set('group::'.$new_id, json_encode($group));
  
  if($ret){
      $g_members['jsonType'] = 'groupmembers';
      $g_members['groupid'] = $new_id;
      $g_members['member'] = array();
      $g_members['request'] = array();
      $g_members['banned'] = array();
      
      $g_members['member'][$userid] = array('userid'=>$userid, 'created_at'=>$ognoo,'type'=>'created');
      $cb->set('groupmembers::'.$new_id, json_encode($g_members));
      $result['message'] = true;
  }else{
      $result['message'] = false;
  }
//  echo $cb->get('groupmembers::'.$new_id);
  echo json_encode($result);
  
}
?>
