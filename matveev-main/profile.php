<?php
session_start();
require_once 'db.php'; 

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user']['id_zakazchiki'];

$sql = "SELECT * FROM zakazchiki WHERE id_zakazchiki = $user_id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
  echo "Пользователь не найден.";
  exit();
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Личный кабинет | Показ мод</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .profile-container {
      max-width: 600px;
      margin: 40px auto;
      padding: 30px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .profile-container h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .profile-info p {
      margin: 10px 0;
      font-size: 18px;
    }

    .profile-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .profile-buttons a {
      text-decoration: none;
      padding: 12px 25px;
      background-color: #2c3e50;
      color: white;
      border-radius: 8px;
      transition: 0.3s;
    }

    .profile-buttons a:hover {
      background-color: #34495e;
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

<div class="profile-container">
  <h2>Личный кабинет</h2>
  <div class="profile-info">
    <p><strong>ФИО:</strong> <?= htmlspecialchars($user['fio']) ?></p>
    <p><strong>Телефон:</strong> <?= htmlspecialchars($user['phone']) ?></p>
    <p><strong>Дата рождения:</strong> <?= htmlspecialchars($user['date_rozd']) ?></p>
    <p><strong>Паспорт:</strong> <?= htmlspecialchars($user['pasport']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p><strong>Адрес:</strong> <?= htmlspecialchars($user['adress']) ?></p>
    <p><strong>Логин:</strong> <?= htmlspecialchars($user['login']) ?></p>
  </div>
  <div class="profile-buttons">
    <a href="edit_profile.php">Редактировать</a>
    <a href="my_bookings.php">Моя бронь</a>
  </div>
</div>

<footer>
  &copy; <?= date('Y') ?> Показ мод. Все права защищены.
</footer>

</body>
</html>
