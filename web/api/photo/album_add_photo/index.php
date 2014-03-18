<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//photo upload
$post_data = post();
$files_data = files($key);
$upload_dir = '../../../../data01';
$date = (date('Ymd'));

//w:75
//w:132
//w:270
//real
$file_name = $userid.rand(10000000,99999999);
if(count($files_data)>0 && count($post_data)>0){
    
    $userid = $post_data['userid'];
    $albumid = $post_data['albumid'];
    $handle = new upload($files_data['image']);
    if ($handle->uploaded) {
      $handle->file_new_name_body   = $file_name;
      $handle->image_resize         = true;
      $handle->image_convert = 'jpg';
      $handle->image_x              = 75;
      $handle->image_y              = 75;
      $handle->image_ratio_crop     = true;
      
      $handle->process($upload_dir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.'s1'.DIRECTORY_SEPARATOR);
        
      $s1 = $handle->processed;
      if($s1){
         $s1_array = array();
         $s1_array['width'] = $handle->image_dst_x;
         $s1_array['height'] = $handle->image_dst_y;
         $s1_array['filesize'] = filesize($handle->file_dst_path.$handle->file_dst_name);
         $s1_array['path'] = $date.DIRECTORY_SEPARATOR.'s1';
      }
      
      $handle->file_new_name_body   = $file_name;
      $handle->image_resize         = true;
      $handle->image_x              = 132;
      $handle->image_convert = 'jpg';
      $handle->image_ratio_crop     = true;
      $handle->process($upload_dir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.'s2'.DIRECTORY_SEPARATOR);
        
      $s2 = $handle->processed;
      
      if($s2){
         $s2_array = array();
         $s2_array['width'] = $handle->image_dst_x;
         $s2_array['height'] = $handle->image_dst_y;
         $s2_array['filesize'] = filesize($handle->file_dst_path.$handle->file_dst_name);
         $s2_array['path'] = $date.DIRECTORY_SEPARATOR.'s2';
      }
      
      $handle->file_new_name_body   = $file_name;
      $handle->image_resize         = true;
      $handle->image_x              = 132;
      $handle->image_convert = 'jpg';
      $handle->image_ratio_crop     = true;
      $handle->process($upload_dir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.'s3'.DIRECTORY_SEPARATOR);
        
      $s3 = $handle->processed;
      
      if($s3){
         $s3_array = array();
         $s3_array['width'] = $handle->image_dst_x;
         $s3_array['height'] = $handle->image_dst_y;
         $s3_array['filesize'] = filesize($handle->file_dst_path.$handle->file_dst_name);
         $s3_array['path'] = $date.DIRECTORY_SEPARATOR.'s3';
      }
      
      $handle->file_new_name_body   = $file_name;
      $handle->image_resize         = true;
      $handle->image_x              = 270;
      $handle->image_convert = 'jpg';
      $handle->image_ratio_crop     = true;
      $handle->process($upload_dir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.'s4'.DIRECTORY_SEPARATOR);
        
      $s4 = $handle->processed;
      
      if($s4){
         $s4_array = array();
         $s4_array['width'] = $handle->image_dst_x;
         $s4_array['height'] = $handle->image_dst_y;
         $s4_array['filesize'] = filesize($handle->file_dst_path.$handle->file_dst_name);
         $s4_array['path'] = $date.DIRECTORY_SEPARATOR.'s4';
      }
      
      $handle->file_new_name_body   = $file_name;
      $handle->image_convert = 'jpg';
      
      $handle->process($upload_dir.DIRECTORY_SEPARATOR.$date.DIRECTORY_SEPARATOR.'s5'.DIRECTORY_SEPARATOR);
        
      $s5 = $handle->processed;
      
      if($s5){
         $s5_array = array();
         $s5_array['width'] = $handle->image_dst_x;
         $s5_array['height'] = $handle->image_dst_y;
         $s5_array['filesize'] = filesize($handle->file_dst_path.$handle->file_dst_name);
         $s5_array['path'] = $date.DIRECTORY_SEPARATOR.'s5';
      }
      
      

      

      if ($s1) {

          $new_name = $handle->file_dst_name;
          
          $new_id = $cb->increment('photo::count');
          $image = array();
          $image['jsonType'] = 'photos';
          $image['photoid'] = $new_id;
          $image['albumid'] = $albumid;
          $image['userid'] = $userid;
          $image['description'] = "";
          $image['name'] =  $new_name;
          $image['file_type'] = $handle->file_dst_name_ext;
          $image['created_at'] = date('Y-m-d H:i:s');
          $image['views'] = 0;
          $image['hits'] = 0;
          $image['downloaded'] = 0;
          $image['types']['s1'] = $s1_array;
          $image['types']['s2'] = $s2_array;
          $image['types']['s3'] = $s3_array;
          $image['types']['s4'] = $s4_array;
          $image['types']['s5'] = $s5_array;
          
          $cb->set('photos::'.$new_id, json_encode($image));
          
          $album = $cb->get('album::'.$albumid);
          
          $album_array = json_decode($album,true);
          
          
          if(!isset($album_array['thumbid'])){
             $album_array['thumbid'] = $new_id; 
          }
          
          $cb->set('album::'.$albumid,  json_encode($album_array));
          
          
          $handle->clean();
          
      }else{
          echo $handle->error;
      }
  }else{
      echo 'error';
      echo $handle->error;
  }
}


/* 
photos::1{
  "jsonType": "photos",
  "photo_id": 1,
  "userid": 1,
  "file_type":"jpg|jpeg",
  "name": "photo_name.jpg",
  "created_at":"2014-02-25 11:41:06",
  "views": "1",
  "hits": "1",
  "downloaded": "1",
  "code":"profile|cover|album_id|wall",
  "types": [
    "s1":{ "width": 180, "height": 180, "filesize": 11942, "protocol":"http://", "domain":"oluulaa.mn", "path": "/folder/folder/"},
    {"type":"2", "width": 180, "height": 180, "filesize": 11942, "protocol":"http://", "domain":"oluulaa.mn", "path": "/folder/folder/"},
    {"type":"3", "width": 180, "height": 180, "filesize": 11942, "protocol":"http://", "domain":"oluulaa.mn", "path": "/folder/folder/"}
  ]
}
 */
