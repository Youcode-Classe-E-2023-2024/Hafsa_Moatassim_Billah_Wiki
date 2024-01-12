<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $User = User::login($email, $password);
    if ($User !== false){
        
        $_SESSION['c'] = $User['id'];
        // $_SESSION['x'] = 'logout';
       
        exit(); 
    } else {
        header('location: index.php?page=login');
        echo 'Incorrect password';
        exit(); 
    }
}

// if (isset($_GET['logout'])) {
//     session_destroy();
//     header('location: index.php?page=home');
//     exit(); 
// }



?>