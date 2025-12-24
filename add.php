<?php 
session_start();
include "db.php";

// Перевірка прав доступу: тільки для адміна
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$message = ""; // Змінна для сповіщень

// Обробка форми після натискання кнопки
if (isset($_POST['submit'])) {
    // Екрануємо ввід для захисту від SQL-ін'єкцій
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $short = mysqli_real_escape_string($conn, $_POST['short_text']);
    $full  = mysqli_real_escape_string($conn, $_POST['full_text']);
    $cat   = $_POST['category'];

    // Робота з файлом зображення
    $imgName = "";
    if (!empty($_FILES['image']['name'])) {
        $imgName = time() . "_" . $_FILES['image']['name']; // Робимо ім'я унікальним
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $imgName);
    }

    // Запит до бази даних
    $sql = "INSERT INTO news (title, short_text, full_text, category, image, date) 
            VALUES ('$title', '$short', '$full', '$cat', '$imgName', NOW())";

    if (mysqli_query($conn, $sql)) {
        $message = "<p class='success'>Новину успішно опубліковано!</p>";
    } else {
        $message = "<p class='error'>Помилка бази даних: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Додати новину</title>
</head>
<body>

<div class="header">Панель керування</div>

<div class="menu">
    <a href="index.php">← Повернутися на головну</a>
</div>

<div class="wrapper">
    <div class="form-container">
        <h2>Створити нову публікацію</h2>
        
        <?= $message ?> <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="title" placeholder="Заголовок новини" required>
            </div>

            <div class="form-group">
                <textarea name="short_text" placeholder="Короткий анонс (для головної сторінки)" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <textarea name="full_text" placeholder="Повний текст новини" rows="10" required></textarea>
            </div>

            <div class="form-group">
                <label>Обкладинка новини:</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <div class="form-group">
                <select name="category">
                    <?php foreach(['Політика', 'Суспільство', 'Технології', 'Спорт'] as $category): ?>
                        <option value="<?= $category ?>"><?= $category ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" name="submit" class="btn-submit">Опублікувати</button>
        </form>
    </div>
</div>

</body>
</html>