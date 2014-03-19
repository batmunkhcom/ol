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
        $p_designdoc = "user_college_design";

        // Create the map function.
        $func1 = "function (doc) {if(doc.jsonType=='college' && doc.userid == '".$userid."' ){emit(doc.userid, doc.collegeid);}}";

        $ddoc = $cb->getDesignDoc($p_designdoc);


        $viewname = 'user_college'.$userid;
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
            $school = $cb->get('college::'.$row['value']);
            $album_array = json_decode($school, true);

            $return['college'][$album_array['collegeid']]['collegeid'] = $album_array['collegeid'];
            $return['college'][$album_array['collegeid']]['country'] = $album_array['country'];
            $return['college'][$album_array['collegeid']]['city'] = $album_array['city'];
            $return['college'][$album_array['collegeid']]['name'] = $album_array['name'];
            $return['college'][$album_array['collegeid']]['class'] = $album_array['class'];
            $return['college'][$album_array['collegeid']]['year_graduated'] = $album_array['year_graduated'];
            $return['college'][$album_array['collegeid']]['department'] = $album_array['department'];


        }
    }else{
        $return['message'] = false;
    }
    echo json_encode($return);
}

