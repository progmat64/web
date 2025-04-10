<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Галерея | Показ мод</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .brand-description {
      text-align: center;
      padding: 40px 20px;
      background: rgba(255, 255, 255, 0.95);
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      padding: 30px;
      background: rgba(255, 255, 255, 0.9);
    }

    .gallery img {
      width: 100%;
      height: 300px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s;
      cursor: pointer;
    }

    .gallery img:hover {
      transform: scale(1.05);
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 2000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.8);
    }

    .modal-content {
      display: block;
      margin: 5% auto;
      max-width: 80%;
      max-height: 80%;
      border-radius: 10px;
      box-shadow: 0 0 20px white;
    }

    .close {
      position: absolute;
      top: 20px;
      right: 40px;
      color: white;
      font-size: 40px;
      font-weight: bold;
      cursor: pointer;
    }

    .close:hover {
      color: #ccc;
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

<div class="brand-description">
  <h1>Галерея наших показов</h1>
  <p>Вдохновляйтесь лучшими моментами наших прошедших мероприятий. Кликните на изображение, чтобы увеличить.</p>
</div>

<div class="gallery">
  <img src="gal1.jpg" alt="Фото 1" onclick="openModal(this.src)">
  <img src="gal2.jpg" alt="Фото 2" onclick="openModal(this.src)">
  <img src="gal3.jpg" alt="Фото 3" onclick="openModal(this.src)">
  <img src="gal4.jpg" alt="Фото 4" onclick="openModal(this.src)">
  <img src="gal5.jpg" alt="Фото 5" onclick="openModal(this.src)">
  <img src="gal6.jpg" alt="Фото 6" onclick="openModal(this.src)">
</div>

<div id="myModal" class="modal" onclick="closeModal()">
  <span class="close" onclick="closeModal()">&times;</span>
  <img class="modal-content" id="modalImg">
</div>

<footer>
  &copy; <?= date('Y') ?> Показ мод. Все права защищены.
</footer>

<script>
  function openModal(src) {
    document.getElementById('myModal').style.display = "block";
    document.getElementById('modalImg').src = src;
  }

  function closeModal() {
    document.getElementById('myModal').style.display = "none";
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") {
      closeModal();
    }
  });
</script>

</body>
</html>
