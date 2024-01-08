<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $User = User::login($email, $password);
    if ($User !== false){
        $_SESSION['x'] = 'logout';
        header('location: index.php?page=');
        $_SESSION['c'] = $User;
    } else {
        header('location: index.php?page=login');
        echo 'incorrect password';
    }
}

if (isset($_POST['logout'])) {
    session_destroy();

} else {
//    echo 'failed';
}


?>