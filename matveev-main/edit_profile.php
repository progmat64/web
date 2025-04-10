<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user']['id_zakazchiki'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $fio = $_POST['fio'];
  $phone = $_POST['phone'];
  $date_rozd = $_POST['date_rozd'];
  $pasport = $_POST['pasport'];
  $email = $_POST['email'];
  $adress = $_POST['adress'];
  $login = $_POST['login'];
  $password = $_POST['password']; 


  $query = "SELECT password FROM zakazchiki WHERE id_zakazchiki = $user_id";
  $res = mysqli_query($conn, $query);
  $current_data = mysqli_fetch_assoc($res);
  $current_password = $current_data['password'];


  if (!empty($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  } else {
    $hashed_password = $current_password;
  }

  $sql = "UPDATE zakazchiki SET 
            fio = '$fio',
            phone = '$phone',
            date_rozd = '$date_rozd',
            pasport = '$pasport',
            email = '$email',
            adress = '$adress',
            login = '$login',
            password = '$hashed_password'
          WHERE id_zakazchiki = $user_id";

  if (mysqli_query($conn, $sql)) {
    header("Location: profile.php");
    exit();
  } else {
    $error = "Ошибка при обновлении данных: " . mysqli_error($conn);
  }
}

$sql = "SELECT * FROM zakazchiki WHERE id_zakazchiki = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Редактировать профиль | Показ мод</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .edit-container {
      max-width: 600px;
      margin: 40px auto;
      padding: 30px;
      background: rgba(255, 255, 255, 0.97);
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0,0,0,0.15);
    }

    .edit-container h2 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 28px;
    }

    form input, form label {
      display: block;
      width: 100%;
      margin-bottom: 15px;
      font-size: 16px;
    }

    input[type="text"],
    input[type="date"],
    input[type="email"],
    input[type="password"] {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
      transition: 0.3s;
    }

    input:focus {
      border-color: #007bff;
      outline: none;
    }

    .btn-save {
      background-color: #2c3e50;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn-save:hover {
      background-color: #34495e;
    }

    .note {
      font-size: 14px;
      color: #555;
      margin-top: -10px;
      margin-bottom: 10px;
    }

    .error {
      color: red;
      text-align: center;
      margin-bottom: 15px;
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

<div class="edit-container">
  <h2>Редактирование профиля</h2>

  <?php if (isset($error)): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>

  <form method="POST">
    <label>ФИО</label>
    <input type="text" name="fio" value="<?= htmlspecialchars($user['fio']) ?>" required>

    <label>Телефон</label>
    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>

    <label>Дата рождения</label>
    <input type="date" name="date_rozd" value="<?= htmlspecialchars($user['date_rozd']) ?>" required>

    <label>Паспорт</label>
    <input type="text" name="pasport" value="<?= htmlspecialchars($user['pasport']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>Адрес</label>
    <input type="text" name="adress" value="<?= htmlspecialchars($user['adress']) ?>" required>

    <label>Логин</label>
    <input type="text" name="login" value="<?= htmlspecialchars($user['login']) ?>" required>

    <label>Новый пароль</label>
    <input type="password" name="password">
    <div class="note">Оставьте поле пустым, если не хотите менять пароль.</div>

    <button type="submit" class="btn-save">Сохранить</button>
  </form>
</div>

<footer>
  &copy; <?= date('Y') ?> Показ мод. Все права защищены.
</footer>

</body>
</html>
