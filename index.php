<?php
require_once 'core/init.php';

$users =  DB::getInstance(); //CALLING CREATED OBJECT IN DB CLASS
//$users->query("SELECT * FROM groups WHERE id = ? ", array('5'));
//$users->action('SELECT *','groups',array('id','=','1'));
//$users->get('groups',array('id','=','2'));
//$users->insert("users",array('user_name'=>'hussein','password' => 'pwd','salt'=>'sugar'));
$users->update("users","2",array('user_name'=>'name','password'=>'pwds'));

//echo $users->error() . "<br>";


/*if (!$users->count()){
    echo "No Users";
}
else{
    echo $users->result()[0]->user_name;

}*/