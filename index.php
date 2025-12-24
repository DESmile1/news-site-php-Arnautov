<?php 
session_start(); // Починаємо сесію для перевірки прав адміна
include "db.php"; 
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Новинний сайт</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>

<div class="header">Останні новини</div>

<div class="menu">
    <a href="index.php">Головна</a>
    
    <?php foreach(['Політика', 'Суспільство', 'Технології', 'Спорт'] as $category): ?>
        <a href="index.php?cat=<?= $category ?>"><?= $category ?></a>
    <?php endforeach; ?>

    <?php if(isset($_SESSION['admin'])): ?>
        <a href="add.php">Додати новину</a>
        <a href="logout.php">Вихід (Адмін)</a>
    <?php else: ?>
        <a href="login.php">Увійти (Адмін)</a>
    <?php endif; ?>

    <form method="get" action="index.php" style="display:inline-block; margin-left:20px;">
        <input type="text" name="search" placeholder="Пошук..." required>
        <button type="submit">Знайти</button>
    </form>
</div>

<div class="wrapper">

<?php
// 1. Обробка запитів: Пошук, Категорія або Всі новини
if(isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $result = mysqli_query($conn, "SELECT * FROM news WHERE title LIKE '%$search%' OR full_text LIKE '%$search%' ORDER BY date DESC");
    echo "<h2>Результати пошуку: '" . htmlspecialchars($search) . "'</h2>";
} elseif(isset($_GET['cat'])) {
    $cat = mysqli_real_escape_string($conn, $_GET['cat']);
    $result = mysqli_query($conn, "SELECT * FROM news WHERE category='$cat' ORDER BY date DESC");
    echo "<h2>$cat</h2>";
} else {
    $result = mysqli_query($conn, "SELECT * FROM news ORDER BY date DESC");
}

// 2. Вивід новин
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="news-card">
            
            <?php if(!empty($row['image'])): ?>
                <div class="news-image">
                    <img src="images/<?= $row['image'] ?>" alt="news">
                </div>
            <?php endif; ?>

            <h2><?= $row['title'] ?></h2>
            <p class="category"><?= $row['category'] ?> | <?= $row['date'] ?></p>
            <p><?= $row['short_text'] ?></p>
            
            <div class="card-actions">
                <a class="btn" href="view.php?id=<?= $row['id'] ?>">Читати далі</a>

                <?php if(isset($_SESSION['admin'])): ?>
                    <a href="delete.php?id=<?= $row['id'] ?>" 
                       class="btn-delete" 
                       onclick="return confirm('Ви впевнені, що хочете видалити цю новину?')">
                       Видалити
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php } 
} else {
    echo "<p>Новин не знайдено.</p>";
}
?>

</div>

</body>
</html>