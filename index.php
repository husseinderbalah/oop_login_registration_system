<?php
require_once 'core/init.php';

$users =  DB::getInstance(); //CALLING CREATED OBJECT IN DB CLASS
//$users->query("SELECT * FROM groups WHERE id = ? ", array('5'));
$users->action('SELECT *','groups',array('id','=','1'));
//echo $users->error() . "<br>";


if ($users->error()){
    echo "No Users";
}
else{echo "OK";}