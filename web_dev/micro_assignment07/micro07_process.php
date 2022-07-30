<?php
    $name = $_POST['username'];
    $password = $_POST['password'];
    $path = getcwd();
    $filename = $path . '/data/loginhistory.txt';
    if (!$name){
        file_put_contents($filename, 'missing'."\n", FILE_APPEND);
        header('Location: micro07.php?error=empty_username');
        exit();
    } else if(!$password){
        file_put_contents($filename, 'missing'."\n", FILE_APPEND);
        header('location: micro07.php?error=empty_password');
        exit();
    } else if ($name!='pikachu' || $password!='pokemon') {
        setcookie('login', 'false');
        file_put_contents($filename, 'unsuccessful'."\n", FILE_APPEND);
        header('location: micro07.php?error=username_password_wrong');
        exit();
    } else if ($name=='pikachu' && $password=='pokemon'){
        setcookie('login', 'true');
        file_put_contents($filename, 'successful'."\n", FILE_APPEND);
        header('location: micro07.php?correct=pokemon_caught');
        exit();
    } else {
        header('location: micro07.php?error=unknown');
        exit();
    }
?>