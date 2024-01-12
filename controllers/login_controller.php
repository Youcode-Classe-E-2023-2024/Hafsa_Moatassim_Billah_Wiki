<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $User = User::login($email, $password);
    if ($User) {


        $_SESSION['id'] = $User['id'];
        $_SESSION['role'] = $User['role'];
        $_SESSION['email'] = $User['email'];

        if ($_SESSION['role'] == 'author') {
            header('location: index.php?page=wiki');
            exit;
        } else {
            header('location: index.php?page=dashboard');
            exit;
        }
    }
}

