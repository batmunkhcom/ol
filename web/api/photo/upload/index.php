<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//photo upload
$post_data = post();
$files_data = files($key);

if(count($files_data)>0){
    $handle = new upload($files_data['image']);
    if ($handle->uploaded) {
        echo 'uplaoded';
//      $handle->file_new_name_body   = $file_name;
      $handle->image_resize         = true;
      $handle->image_x              = 250;
      $handle->image_y              = 250;
      $handle->image_ratio_crop     = true;
      
      $handle->process('../../../uploads');
        
      $medium = $handle->processed;
      
      
      
//      echo $file_name;
      

      if ($medium) {

          $new_name = $handle->file_dst_name;
      		
          $handle->clean();
          echo $new_name;
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
    {"type":"1", "width": 180, "height": 180, "filesize": 11942, "protocol":"http://", "domain":"oluulaa.mn", "path": "/folder/folder/"},
    {"type":"2", "width": 180, "height": 180, "filesize": 11942, "protocol":"http://", "domain":"oluulaa.mn", "path": "/folder/folder/"},
    {"type":"3", "width": 180, "height": 180, "filesize": 11942, "protocol":"http://", "domain":"oluulaa.mn", "path": "/folder/folder/"}
  ]
}
 */
