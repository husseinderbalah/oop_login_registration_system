<?php
require_once 'core/init.php';
if (Input::request()){
    $validate = new Validation();
    $validate->check($_POST,array(
        'userName'  => array(
            'required' => true,
            'min'     => 6,
            'max'     => 20,
            'unique'  => true,
        ),
        'password'  => array(
            'required' => 'true',
            'min' => 6
        ),
        'password2' => array(
            'required' => true,
            'matches' => 'password',
        ),
        'name'      => array(
            'required' => true,
            'min' => 6,
            'max' => 50
        )
    ));
    if ($validate->passed()){
        echo 'passed';
    }
    else{ foreach($validate->errors() as $error){
        echo $error . "<br>";
        }
    }
}

?>
<form action="" method="post">
    <div class="field">
        <label for="userName">Enter User Name</label>
        <input type="text" name="userName" id="userName" value="<?echo Input::getInput("userName")?>" autocomplete="off">
    </div>

    <div class="field">
        <label for="password">Enter Password</label>
        <input type="password" name="password" id="password">
    </div>

    <div class="field">
        <label for="password2">Enter Password Again</label>
        <input type="password" name="password2" id="password2">
    </div>

    <div class="field">
        <label for="name">name</label>
        <input type="text" name="name" id="name" value="<?echo Input::getInput("name")?>" autocomplete="off">
    </div>
        <input type="submit" name="register" id="register" value="register">
</form>
