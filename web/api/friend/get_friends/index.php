<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//get album photo
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    //photos
    $p_designdoc = "user_friends";

    // Create the map function.
    $func1 = "function (doc) {if(doc.jsonType=='userfriend' && doc.userid == '".$userid."' ){emit(doc.userid, doc.friendids);}}";

    $ddoc = $cb->getDesignDoc($p_designdoc);
    
    
    $viewname = 'friends'.$albumid;
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
        
        $arr = json_decode($row['value'], true);
        
        $return['friends'][];
        
        
    }
    
    echo json_encode($return);
    
}



?>
