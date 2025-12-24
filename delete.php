<?php
session_start();
include "db.php";

// 1. Перевіряємо, чи це адмін
if(isset($_SESSION['admin']) && isset($_GET['id'])) {
    
    $id = (int)$_GET['id']; // Перетворюємо в число для безпеки
    
    // 2. Видаляємо новину з бази
    mysqli_query($conn, "DELETE FROM news WHERE id = $id");
}

// 3. Повертаємося назад на головну
header("Location: index.php");
exit;
?>