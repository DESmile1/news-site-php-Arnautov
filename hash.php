<?php
$password = '12345'; // Пароль, який ви хочете захешувати
$hash = password_hash($password, PASSWORD_DEFAULT);
echo "Ваш хеш: " . $hash;
?>