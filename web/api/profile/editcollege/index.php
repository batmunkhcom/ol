<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../../../global/db.php';
require '../../../../common/_.php';



$post_data =  post();
if(count($post_data)>0){
//    echo $cb->get('college::count');die();
    $colleges = $post_data['college'];
    foreach ($colleges as $college) {
        if($college['collegeid']=='new'){
            
            $new_id = $cb->increment('college::count');
            $college['jsonType'] = 'college';
            $college['collegeid'] = $new_id;
            $college_json = json_encode($college);
            $cb->set('college::'.$new_id, $college_json);
            
        }else{
            $json = $cb->get('college::'.$college['collegeid']);
            $arr = json_decode($json,true);
            if($arr['userid']==$college['userid']){
                $college['jsonType'] = 'college';
                $school_json = json_encode($college);
                $cb->set('college::'.$arr['collegeid'], $school_json);
                
            }
        }
    }
    
}

