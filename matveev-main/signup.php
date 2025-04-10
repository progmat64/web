<?php
session_start();
require_once 'db.php';  

$fio = $_POST['fio'];
$phone = $_POST['phone'];
$date_rozd = $_POST['date_rozd'];
$pasport = $_POST['pasport'];
$email = $_POST['email'];
$adress = $_POST['adress'];
$login = $_POST['login'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$user_captcha = $_POST['captcha'] ?? '';

if (!isset($_SESSION['captcha']) || (int)$user_captcha !== (int)$_SESSION['captcha']) {
    $_SESSION['message'] = 'Неверный ответ на капчу.';
    header('Location: register.php');
    exit();
}
unset($_SESSION['captcha']); 

if ($password !== $confirm_password) {
    $_SESSION['message'] = 'Ошибка при регистрации! Пароли не совпадают.';
    header('Location: register.php');
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("SELECT * FROM zakazchiki WHERE login = ?");
$stmt->bind_param("s", $login);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $_SESSION['message'] = 'Ошибка при регистрации! Логин уже занят.';
    header('Location: register.php');
    exit();
}

$stmt = $conn->prepare("INSERT INTO zakazchiki (fio, phone, date_rozd, pasport, email, adress, login, password)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $fio, $phone, $date_rozd, $pasport, $email, $adress, $login, $hashed_password);


if ($stmt->execute()) {
    $_SESSION['user'] = [
        'id_zakazchiki' => $conn->insert_id,
        'fio' => $fio,
        'phone' => $phone,
        'date_rozd' => $date_rozd,  
        'pasport' => $pasport,
        'email' => $email,
        'adress' => $adress, 
        'login' => $login
    ];
    unset($_SESSION['user']); 

    $_SESSION['message'] = 'Регистрация прошла успешно!';
    header('Location: login.php');
    exit();
} else {
    $_SESSION['message'] = 'Ошибка при регистрации!';
    header('Location: register.php');
    exit();
}

?>
