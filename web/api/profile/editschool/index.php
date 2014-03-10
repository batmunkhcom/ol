<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//editschool

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
    
    $schools = $post_data['school'];
    
    foreach ($schools as $school) {
        if($school['schoolid']=='new'){
            $new_id = $cb->increment('school::count');
            $school['jsonType'] = 'school';
            $school['schoolid'] = $new_id;
            $school_json = json_encode($school);
            $cb->set('school::'.$new_id, $school_json);
        }else{
            $json = $cb->get('school::'.$school['schoolid']);
            $arr = json_decode($json,true);
            if($arr['userid']==$school['userid']){
                $school['jsonType'] = 'school';
                $school_json = json_encode($school);
                $cb->set('school::'.$arr['schoolid'], $school_json);
                
            }
        }
    }
    
}

