<?php
class DB{
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;
    private function __construct(){
        try{
        $this->_pdo = new PDO('mysql:host='.Config::getConfig("mysql/host")
                    .';dbname='.Config::getConfig("mysql/dbName")
                    ,Config::getConfig("mysql/userName")
                    ,Config::getConfig("mysql/password"));
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
        echo "connected";
    }
        catch(PDOException $e ){
           echo $e->getMessage();
        }

    }
    //CREATING OBJECT FROM THIS CLASS AUTOMATICALLY
    public static function getInstance(){
        if (!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }
    public function query($sql,$params = array()){
        $this->_error = false;
        if ($this->_query = $this->_pdo->prepare($sql)){
            echo "prepared";
            if (count($params)){
                $pos = 1;
                foreach ($params as $param){
                    $this->_query->bindValue($pos , $param);
                    $pos++;
                }
            }
            if ($this->_query->execute()){
                echo "executed". "<br>";
                    $this->_count = $this->_query->rowCount();
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);

            }
            else { $this->_error = true;}


        }
        return $this;
    }

    public function action($action , $table , $where = array()){
        if (count($where) === 3){
            $operators = array('=','>','<','>=','<=');
            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];
            if (in_array($operator, $operators)){
                $sql = "$action FROM `$table` WHERE `$field` $operator ?";
                if (!$this->query($sql,array($value))->error()){
                    return $this;
                }
            }
        }

    }

    public function get($table, $where){
        return $this->action("SELECT *",$table,$where);
    }
    public function delete($table, $where){
        return $this->action("DELETE",$table,$where);
    }

    public function error(){
        return $this->_error;
    }
    public function count(){
        return $this->_count;
    }
    public function result(){
        return $this->_results;
    }

}