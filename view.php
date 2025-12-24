<?php include "db.php"; ?>

<link rel="stylesheet" href="style.css">

<div class="header">Перегляд новини</div>

<div class="menu">
<a href="index.php">Головна</a>
</div>

<div class="wrapper">

<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM news WHERE id=$id");
$row = mysqli_fetch_assoc($result);
?>

<h1><?php echo $row['title']; ?></h1>
<p class="category"><?php echo $row['category']; ?> | <?php echo $row['date']; ?></p>
<p><?php echo nl2br($row['full_text']); ?></p>

</div>
