<?php
class Input{
    public static function request($type = 'POST'){
        switch ($type){
            case 'POST':
                return (!empty($_POST)) ? true : false;
            break;
            case 'GET':
                return (!empty($_GET)) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }
    public static function getInput($input){
        if (isset($_POST[$input])){
            return $_POST[$input];
        }
        else if (isset($_GET[$input])){
            return $_GET[$input];
        }
         return '';
    }
}