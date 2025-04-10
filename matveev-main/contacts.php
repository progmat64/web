<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Контакты | Показ мод</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .contact-section {
      max-width: 900px;
      margin: 40px auto;
      padding: 30px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.15);
      text-align: center;
    }

    .contact-section h1 {
      font-size: 32px;
      margin-bottom: 20px;
    }

    .contact-details {
      font-size: 18px;
      line-height: 1.6;
      margin-bottom: 30px;
    }

    .map-image {
      display: inline-block;
      overflow: hidden;
      border-radius: 10px;
      transition: transform 0.3s ease;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .map-image img {
      width: 100%;
      max-width: 500px;
      transition: transform 0.3s ease;
      border-radius: 10px;
      cursor: pointer;
    }

    .map-image:hover img {
      transform: scale(1.05);
    }
    footer {
    background: rgba(0, 0, 0, 0.8);
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 40px;
  }
  </style>
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

<div class="contact-section">
  <h1>Контактная информация</h1>

  <div class="contact-details">
    <p><strong>Адрес:</strong> Волгоградская область, г. Урюпинск, пер. Кирпичный, д. 4</p>
    <p><strong>Телефон:</strong> +7 (999) 123-45-67</p>
    <p><strong>Email:</strong> info@fashion-show.ru</p>
    <p><strong>График работы:</strong> Пн - Пт: 10:00 - 18:00<br>Сб - Вс: выходной</p>
  </div>

  <a href="https://yandex.ru/maps/?text=Волгоградская%20область%20г.%20Урюпинск%20пер.%20Кирпичный%20д.2" target="_blank" class="map-image">
    <img src="map-preview.jpg" alt="Карта с адресом">
  </a>

  <p style="margin-top: 10px; font-size: 14px; color: #555;">Нажмите на изображение, чтобы открыть карту</p>
</div>

<footer>
  &copy; <?= date('Y') ?> Показ мод. Все права защищены.
</footer>

</body>
</html>
