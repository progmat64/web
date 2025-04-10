<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['booking_id']) && is_numeric($_POST['booking_id'])) {
    $booking_id = $_POST['booking_id'];
    $user_id = $_SESSION['user']['id_zakazchiki']; 

    $sql_check = "SELECT * FROM bookings WHERE id = ? AND user_id = ?";
    $stmt_check = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt_check, 'ii', $booking_id, $user_id);
    mysqli_stmt_execute($stmt_check);
    $result_check = mysqli_stmt_get_result($stmt_check);

    if (mysqli_num_rows($result_check) > 0) {
        $sql_delete = "DELETE FROM bookings WHERE id = ? AND user_id = ?";
        $stmt_delete = mysqli_prepare($conn, $sql_delete);
        mysqli_stmt_bind_param($stmt_delete, 'ii', $booking_id, $user_id);
        if (mysqli_stmt_execute($stmt_delete)) {
            $_SESSION['success_message'] = "Вы успешно отменили бронирование.";
        } else {
            $_SESSION['error_message'] = "Ошибка при отмене бронирования.";
        }
    } else {
        $_SESSION['error_message'] = "Вы не можете отменить это бронирование.";
    }

    header('Location: my_bookings.php');
    exit();
} else {
    $_SESSION['error_message'] = "Неверные данные для отмены бронирования.";
    header('Location: my_bookings.php');
    exit();
}
