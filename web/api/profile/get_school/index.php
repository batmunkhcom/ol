<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $userid = $post_data['userid'];
    $return = array();
    $json = $cb->get('userprofile::'.$userid);
    if($json){
        $p_designdoc = "user_school_design";

        // Create the map function.
        $func1 = "function (doc) {if(doc.jsonType=='school' && doc.userid == '".$userid."' ){emit(doc.userid, doc.schoolid);}}";

        $ddoc = $cb->getDesignDoc($p_designdoc);


        $viewname = 'user_school'.$userid;
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
            $school = $cb->get('school::'.$row['value']);
            $album_array = json_decode($school, true);

            $return['school'][$album_array['schoolid']]['schoolid'] = $album_array['schoolid'];
            $return['school'][$album_array['schoolid']]['country'] = $album_array['country'];
            $return['school'][$album_array['schoolid']]['city'] = $album_array['city'];
            $return['school'][$album_array['schoolid']]['name'] = $album_array['name'];
            $return['school'][$album_array['schoolid']]['class'] = $album_array['class'];
            $return['school'][$album_array['schoolid']]['grad_year'] = $album_array['grad_year'];


        }
    }else{
        $return['message'] = false;
    }
    echo json_encode($return);
}

