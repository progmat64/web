<?php
session_start();
require_once 'db.php';

$login = $_POST['login'];
$password = $_POST['password'];
$user_captcha = $_POST['captcha'];

if (!isset($_SESSION['captcha']) || (int)$user_captcha !== (int)$_SESSION['captcha']) {
    $_SESSION['message'] = 'Неверный ответ на капчу.';
    header('Location: login.php');
    exit();
}
unset($_SESSION['captcha']); 

$stmt = $conn->prepare("SELECT * FROM zakazchiki WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
}
  if (password_verify($password, $user['password'])) {
    if ($user) {
            $_SESSION['user'] = [
                "id_zakazchiki" => $user['id_zakazchiki'],
                'fio' => $user['fio'],
                'phone' => $user['phone'],
                'date_rozd' => $user['date_rozd'],  
                'pasport' => $user['pasport'],
                'email' => $user['email'],
                'adress' => $user['adress'], 
                'login' => $user['login']
            ];
            header('Location: index.php');
                exit();
        } 
    } else {
        $_SESSION['message'] = 'Неверный логин или пароль';
        header('Location: login.php');
        exit();
    }

?>
