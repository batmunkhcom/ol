<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//photo upload
$post_data = post();
$files_data = files($key);

if(count($files_data)>0){
    var_dump($files_data);
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
