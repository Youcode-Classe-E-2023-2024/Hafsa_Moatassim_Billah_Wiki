<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $User = User::login($email, $password);
    if ($User !== false){
        $_SESSION['x'] = 'logout';
        $_SESSION['c'] = $User["id"];
        if($User['role'] == 'admin'){
            header('location: index.php?page=dashboard');
        } else {
            header('location: index.php?page=wiki');
        }
        exit(); 
    } else {
        header('location: index.php?page=login');
        echo 'Incorrect password';
        exit(); 
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: index.php?page=home');
    exit(); 
}



?>