<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//edit job
require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    $jobs = $post_data['job'];
    foreach ($jobs as $job) {
        if($job['jobid']=='new'){
            $new_id = $cb->increment('job::count');
            $job['jsonType'] = 'job';
            $job['jobid'] = $new_id;
            $college_json = json_encode($job);
            $cb->set('job::'.$new_id, $college_json);
            
        }else{
            $json = $cb->get('job::'.$job['jobid']);
            $arr = json_decode($json,true);
            if($arr['userid']==$job['userid']){
                
                $job['jsonType'] = 'job';
                $school_json = json_encode($job);
                $cb->set('job::'.$arr['jobid'], $school_json);
                
            }
        }
    }
    
}

