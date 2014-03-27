<?php
require '../../../../global/db.php';
require '../../../../common/_.php';  
//add friend
$post_data = post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $albumid = $post_data['albumid'];
    
    $photo_json = $cb->get('album::'.$albumid);
//    echo $photo_json;die();

    if($photo_json){
        $photo_array = json_decode($photo_json, true);
        if($photo_array['userid']==$userid){
            
            $cb->delete('album::'.$albumid);
            
            $p_designdoc = "album_photo_design";

            // Create the map function.
            $func1 = "function (doc) {if(doc.jsonType=='photos' && doc.albumid=='".$albumid."' && doc.userid == '".$userid."' ){emit(doc.userid, doc.photoid);}}";

            $ddoc = $cb->getDesignDoc($p_designdoc);

            $viewname = 'photo_album'.$albumid;
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
                $cb->delete($row['id']);
            }
            
        }
        var_dump($result);
        
    }
    
}
?>
