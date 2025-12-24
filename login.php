<?php
session_start();
include "db.php";

$message = "";

if(isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pass = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE login='$login'");
    
    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        if(password_verify($pass, $user['password'])) {
            $_SESSION['admin'] = true;
            $_SESSION['login'] = $user['login'];
            header("Location: index.php");
            exit;
        } else {
            $message = "Невірний пароль!";
        }
    } else {
        $message = "Користувача не знайдено!";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="header">Авторизація адміністратора</div>

<div class="wrapper">
<form method="post">

<p><?php echo $message; ?></p>

<input type="text" name="login" placeholder="Логін" required><br><br>
<input type="password" name="password" placeholder="Пароль" required><br><br>

<button type="submit" name="submit">Увійти</button>
</form>
</div>
