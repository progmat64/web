<?php
session_start();
require_once 'db.php';

// Проверка на авторизацию
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Проверка на наличие выбранных показов
if (isset($_POST['pokaz_ids']) && !empty($_POST['pokaz_ids'])) {
    $pokaz_ids = $_POST['pokaz_ids'];
    $user_id = $_SESSION['user']['id_zakazchiki']; // предположим, что ID пользователя хранится в сессии

    // Начало транзакции
    mysqli_begin_transaction($conn);

    try {
        foreach ($pokaz_ids as $id_pokaz) {
            // Добавление записи о бронировании в таблицу бронирований
            $sql = "INSERT INTO bookings (user_id, pokaz_id, booking_date) VALUES (?, ?, CURRENT_TIMESTAMP)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ii', $user_id, $id_pokaz);
            mysqli_stmt_execute($stmt);

        }

        // Подтверждение транзакции
        mysqli_commit($conn);
        $_SESSION['success_message'] = "Вы успешно забронировали выбранные показы!";
        header('Location: my_bookings.php');
        exit();
    } catch (Exception $e) {
        // Откат транзакции в случае ошибки
        mysqli_rollback($conn); // Исправленная функция
        $_SESSION['error_message'] = "Произошла ошибка при бронировании. Попробуйте еще раз.";
    }

    header('Location: booking.php');
    exit();
} else {
    $_SESSION['error_message'] = "Пожалуйста, выберите хотя бы один показ для бронирования.";
    header('Location: booking.php');
    exit();
}
?>
