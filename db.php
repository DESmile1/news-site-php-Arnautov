<?php
// Параметри для локалки
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "news_site";

$conn = mysqli_connect($host, $user, $pass, $db_name);

// Перевірка чи запрацювало
if (!$conn) {
    echo "База не підключилася: " . mysqli_connect_error();
    exit;
}
?>