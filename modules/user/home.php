<?php
//$cb = new Couchbase("10.1.1.51:8091", "", "default");
//echo $cb->get('user::6');
//echo phpinfo();

//$json = file_get_contents('http://www.oluulaa.mn/main/ajaxupload/test');
//$obj = json_decode($json,true);
//
//foreach ($obj as $value) {
//    $var = json_encode($value);
//    $cb->set('user::'.$value['userid'],$var);
//}

//$cb->set("user::count", 536);
//$new_id = $cb->increment("user::count");
//echo $cb->get("user::count");

//echo $cb->get('user::536');

//$db = new Database();

//$db->get('user::6');
//$rd = new Profile\Test;
//$rd->Test();

//use Basement\Client;

//$client = new Client();

//$client = new \Basement\Client();

$cb = Config::get('cb');
echo $cb->get('user::6');

?>