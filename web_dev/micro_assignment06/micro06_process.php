<?php
    $name = $_POST['username'];
    $password = $_POST['password'];
    if (!$name){
        header('Location: micro06.php?error=empty_username');
        exit();
    } else if(!$password){
        header('location: micro06.php?error=empty_password');
        exit();
    } else if ($name!='pikachu' || $password!='pokemon') {
        header('location: micro06.php?error=username_password_wrong');
        exit();
    } else if ($name=='pikachu' && $password=='pokemon'){
        header('location: micro06.php?correct=pokemon_caught');
        exit();
    } else {
        header('location: micro06.php?error=unknown');
        exit();
    }
?>