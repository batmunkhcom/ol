<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    
//    $viewname = "myview";
    $a_designdoc = "album_design";

    // Create the map function.
    $func = "function (doc) {if(doc.jsonType=='album' && doc.userid == '".$userid."' ){emit(doc.userid, doc.albumid);}}";

    $ddoc = $cb->getDesignDoc($a_designdoc);
    
   
    
    $viewname = 'myview'.$userid;
    $ddoc_array = json_decode($ddoc, true);
    if (isset($ddoc_array['views'][$viewname])) {
        $result = $cb->view($a_designdoc, $viewname);
    }else{
        $ddoc_array['views'][$viewname]['map'] = $func;
        $ret = $cb->setDesignDoc($a_designdoc, json_encode($ddoc_array));
        $cb->getDesignDoc($a_designdoc);
        $result = $cb->view($a_designdoc, $viewname);
    }
    
    $return = array();
    foreach ($result['rows'] as $row) {
        $album = $cb->get('album::'.$row['value']);
        $album_array = json_decode($album, true);
        
        $return['albums'][$album_array['albumid']]['title'] = $album_array['title'];
        $return['albums'][$album_array['albumid']]['albumid'] = $album_array['albumid'];
        $return['albums'][$album_array['albumid']]['discription'] = $album_array['description'];
        if(isset($album_array['thumbid']) && $album_array['thumbid']==true){
            $thumb_json = $cb->get('photos::'.$album_array['thumbid']);
            if($thumb_json){
                $thumb = json_decode($thumb_json, true);
                $return['albums'][$album_array['albumid']]['thumb'] = IMG_DOMAIN.$thumb['types']['s4']['path'].DIRECTORY_SEPARATOR.$thumb['name'];
            }
        }
    }
    
    //photos
    $p_designdoc = "photo_design";

    // Create the map function.
    $func1 = "function (doc) {if(doc.jsonType=='photos' && doc.userid == '".$userid."' ){emit(doc.userid, doc.photoid);}}";

    $ddoc = $cb->getDesignDoc($p_designdoc);
    
   
    
    $viewname = 'myview'.$userid;
    $ddoc_array = json_decode($ddoc, true);
    if (isset($ddoc_array['views'][$viewname])) {
        $result = $cb->view($p_designdoc, $viewname);
    }else{
        $ddoc_array['views'][$viewname]['map'] = $func1;
        $ret = $cb->setDesignDoc($p_designdoc, json_encode($ddoc_array));
        $cb->getDesignDoc($p_designdoc);
        $result = $cb->view($p_designdoc, $viewname);
    }
    
    foreach ($result['rows'] as $row) {
        $album = $cb->get('photos::'.$row['value']);
        $album_array = json_decode($album, true);
        
        $return['photos'][$album_array['photoid']]['photoid'] = $album_array['photoid'];
        $return['photos'][$album_array['photoid']]['path'] = IMG_DOMAIN.$album_array['types']['s2']['path'].DIRECTORY_SEPARATOR.$album_array['name'];
        
        
    }
    
    echo json_encode($return);
    
    
    
   

//    var_dump($result);die();
    
    
    /*$viewname = "myview".$userid;
    $designdoc = "dev_mydesign2";

    // Create the map function.
    $func = "function (doc) {if(doc.jsonType=='album' && doc.userid == '".$userid."' ){emit(doc.userid, doc.albumid);}}";

    // Create document containing the map function
    $ddoc = json_encode('{"views":{"' . $viewname .
                        '":{"map":"' . $func . '"}}}');

    // Create the design document on the server
    $ret = $cb->setDesignDoc($designdoc, json_decode($ddoc));
    if ($ret) {
       print "View successfully created" . PHP_EOL;
    } else {
       print "Failed to create view: " . $cb->getResultMessage() . PHP_EOL;
    }

    // Try to retrieve the desgin document:
    $ddoc = $cb->getDesignDoc($designdoc);
    print "The design document looks like: " . PHP_EOL;
    var_dump($ddoc);
    
    $result = $cb->view($designdoc, $viewname);
    var_dump($result);
    foreach($result["rows"] as $row) {
      echo $row['key'] . "\n";
    }

//     Delete the design document:
    $ret = $cb->deleteDesignDoc($designdoc);
    if ($ret) {
       print "View successfully deleted" . PHP_EOL;
    } else {
       print "Failed to delete view: " . $cb->getResultMessage() . PHP_EOL;
    }*/
}



?>
