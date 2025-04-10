<?php 
session_start();
require_once 'db.php';

// Запрос для получения всех показов с изображениями и информацией об изделиях
$query = "
    SELECT p.*, i.name AS izdelie_name 
    FROM pokaz p
    JOIN izdelie i ON p.id_izdelia = i.id_izdelia
";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Показ мод</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
  <img src="logo.png" class="logo" alt="Логотип">
  <nav>
    <a href="index.php">Главная</a>
    <a href="gallery.php">Галерея</a>
    <a href="booking.php">Бронировать</a>
    <a href="profile.php">Личный кабинет</a>
    <a href="contacts.php">Контакты</a>
    <?php if (!isset($_SESSION['user'])): ?>
      <a href="login.php">Вход</a>
      <a href="register.php">Регистрация</a>
    <?php else: ?>
      <a href="logout.php">Выход</a>
    <?php endif; ?>
  </nav>
</header>

<div class="brand-description">
  <h1>Добро пожаловать в наш модный дом!</h1>
  <p>Мы создаем стиль, вдохновение и уникальные показы мод по всей стране.</p>
  <p>Показ мод — это мероприятие, устраиваемое модельером для демонстрации своей будущей линии одежды и/или аксессуаров во время недели моды...</p>
</div>

<div class="card-container">
  <?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="card">
        <img src="<?= $row['image'] ?>" alt="Фото показа">
        <div class="card-body">
          <h3><?= htmlspecialchars($row['nazvanie']) ?></h3>
          <p><strong>Дата:</strong> <?= $row['date'] ?> в <?= $row['time'] ?></p>
          <p><strong>Место:</strong> <?= htmlspecialchars($row['place']) ?></p>
          <p><strong>Изделие:</strong> <?= htmlspecialchars($row['izdelie_name']) ?></p>
          <a href="booking.php" class="btn">Подробнее</a>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>Показов нет.</p>
  <?php endif; ?>
</div>

<footer>
  &copy; <?= date('Y') ?> Показ мод. Все права защищены.
</footer>

</body>
</html>
