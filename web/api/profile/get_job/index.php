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
        $return['message'] = true;
        $p_designdoc = "user_job_design";

        // Create the map function.
        $func1 = "function (doc) {if(doc.jsonType=='job' && doc.userid == '".$userid."' ){emit(doc.userid, doc.jobid);}}";

        $ddoc = $cb->getDesignDoc($p_designdoc);


        $viewname = 'user_job'.$userid;
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
            $school = $cb->get('job::'.$row['value']);
            $album_array = json_decode($school, true);

            $return['job'][$album_array['jobid']]['jobid'] = $album_array['jobid'];
            $return['job'][$album_array['jobid']]['country'] = $album_array['country'];
            $return['job'][$album_array['jobid']]['city'] = $album_array['city'];
            $return['job'][$album_array['jobid']]['branch'] = $album_array['branch'];
            $return['job'][$album_array['jobid']]['company'] = $album_array['company'];
            $return['job'][$album_array['jobid']]['position'] = $album_array['position'];
            $return['job'][$album_array['jobid']]['year_start'] = $album_array['year_start'];
            $return['job'][$album_array['jobid']]['year_end'] = $album_array['year_end'];
            $return['job'][$album_array['jobid']]['odoo_hurtel'] = $album_array['odoo_hurtel'];


        }
    }else{
        $return['message'] = false;
    }
    echo json_encode($return);
}

