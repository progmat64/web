<?php 
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$captcha_result = $num1 + $num2;
$_SESSION['captcha'] = $captcha_result;?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Авторизация</title>
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
    .login-form {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.2);
      width: 350px;
    }
    .login-form h2 {
      text-align: center;
    }
    .login-form input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .login-form button {
      width: 100%;
      padding: 10px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .login-form button:hover {
      background-color: #0056b3;
    }
    .login-form .register-link {
      margin-top: 15px;
      text-align: center;
    }
    .login-form .register-link a {
      color: #007BFF;
      text-decoration: none;
    }
    .login-form .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <form class="login-form" action="signin.php" method="POST">
    <h2>Вход</h2>
    <input type="text" name="login" placeholder="Логин" required>
    <input type="password" name="password" placeholder="Пароль" required>

    <label for="captcha">Капча</label>
            <p><?php echo "$num1 + $num2 = "; ?></p>
            <input type="number" name="captcha" id="captcha" placeholder="Ответ" required>

    <button type="submit">Войти</button>

    <div class="register-link">
      Нет аккаунта? <a href="register.php">Зарегистрироваться</a>
      <?php if (isset($_SESSION['message'])): ?>
                <p class="msg"><?php echo htmlspecialchars($_SESSION['message']); ?></p>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
    </div>
  </form>

</body>
</html>
