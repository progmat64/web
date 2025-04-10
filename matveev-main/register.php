<?php
session_start();

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$captcha_result = $num1 + $num2;
$_SESSION['captcha'] = $captcha_result;
?><!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Регистрация</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('bg.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .register-form {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      width: 350px;
    }
    .register-form h2 {
      text-align: center;
    }
    .register-form input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .register-form button {
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .register-form button:hover {
      background-color: #0056b3;
    }
    .register-form .login-link {
      margin-top: 15px;
      text-align: center;
    }
    .register-form .login-link a {
      color: #007BFF;
      text-decoration: none;
    }
    .register-form .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <form class="register-form" action="signup.php" method="POST">
    <h2>Регистрация</h2>
    <input type="text" name="fio" placeholder="ФИО" required>
    <input type="text" name="phone" placeholder="Телефон" required>
    <input type="date" name="date_rozd" placeholder="Дата рождения" required>
    <input type="text" name="pasport" placeholder="Паспорт" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="adress" placeholder="Адрес" required>
    <input type="text" name="login" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>
    <input type="password" name="confirm_password" placeholder="Подтвердите пароль" required>

    <label for="captcha">Капча</label>
            <p><?php echo "$num1 + $num2 = "; ?></p>
            <input type="number" name="captcha" id="captcha" placeholder="Ответ" required>

    <button type="submit">Зарегистрироваться</button>

    <div class="login-link">
      У вас уже есть аккаунт? <a href="login.php">Войти</a>
      <?php if (isset($_SESSION['message'])): ?>
                <p class="msg"><?php echo htmlspecialchars($_SESSION['message']); ?></p>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
    </div>
    
  </form>
</body>
</html>
