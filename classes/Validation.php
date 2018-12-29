<?php

class Validation{
    private $_passed = false,
            $_errors = array(),
            $_db = null;
    public function __construct(){
        $this->_db = DB::getInstance();
    }
    public function check($requestType, $items = array()){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $ruleValue){
                $value = trim($requestType[$item]);

                if ($rule === 'required' && empty($value)){
                    $this->addErrors("$item is required");
                }
                else {
                    switch ($rule){
                        case 'min':
                            if (strlen($value) < $ruleValue){
                                $this->addErrors("$item must be more than $ruleValue");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $ruleValue){
                                $this->addErrors("$item must be less than $ruleValue");
                            }
                            break;
                        case 'matches':
                            if (!empty($value)) {
                                if (empty($requestType[$ruleValue])){
                                    $this->addErrors("Enter {$ruleValue} first");
                                }
                                elseif ($value !== $requestType[$ruleValue]){
                                    $this->addErrors("$item does not match");
                                }
                            }
                            break;
                        case 'unique':
                            if (!empty($value)){
                                $this->_db->get("users",array("user_name","=",$value));
                                if ($this->_db->count()){
                                    $this->addErrors("$item already used");
                                }
                                else{
                                    echo 'success';
                                }
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->_errors)){
            $this->_passed = true;
        }
        //return $this;
    }

    private function addErrors($errorMsg){
        $this->_errors[] = $errorMsg;
    }
    public function errors(){
        return $this->_errors;
    }
    public function passed(){
        return $this->_passed;
    }
}