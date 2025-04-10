<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user']['id_zakazchiki'];

$sql = "
    SELECT 
        b.id AS booking_id,
        p.nazvanie AS pokaz,
        p.date AS date,
        p.time AS time,
        p.place AS place,
        s.full_name AS sotrudniki,
        i.name AS izdelie,
        m.naimenovanie AS material,
        k.nazvanie AS kategory
    FROM bookings b
    JOIN pokaz p ON b.pokaz_id = p.id_pokaz
    LEFT JOIN sotrudniki s ON p.id_sotrudnik = s.id_sotrudnik
    LEFT JOIN izdelie i ON p.id_izdelia = i.id_izdelia
    LEFT JOIN material m ON i.id_material = m.id_material
    LEFT JOIN kategory k ON i.id_kotegory = k.id_kategory
    WHERE b.user_id = $user_id
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Моя бронь | Показ мод</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .my-bookings-container {
            padding: 40px;
            background: rgba(255, 255, 255, 0.95);
        }

        .my-bookings-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .my-bookings-table th, .my-bookings-table td {
            padding: 12px 16px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .my-bookings-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .my-bookings-table tr:hover {
            background-color: #f0f0f0;
        }

        .cancel-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
        }

        .cancel-button:hover {
            background-color: #c0392b;
        }
        .button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }

        .button:hover {
            background-color: #2980b9;
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

<div class="my-bookings-container">
    <h1 style="text-align:center;">Моя бронь</h1>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <table class="my-bookings-table">
            <thead>
                <tr>
                    <th>Название показа</th>
                    <th>Дата</th>
                    <th>Время</th>
                    <th>Место</th>
                    <th>Сотрудник</th>
                    <th>Изделие</th>
                    <th>Материал</th>
                    <th>Категория</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['pokaz']) ?></td>
                        <td><?= htmlspecialchars($row['date']) ?></td>
                        <td><?= htmlspecialchars($row['time']) ?></td>
                        <td><?= htmlspecialchars($row['place']) ?></td>
                        <td><?= htmlspecialchars($row['sotrudniki']) ?></td>
                        <td><?= htmlspecialchars($row['izdelie']) ?></td>
                        <td><?= htmlspecialchars($row['material']) ?></td>
                        <td><?= htmlspecialchars($row['kategory']) ?></td>
                        <td>
                            <form method="POST" action="cancel_booking.php">
                                <input type="hidden" name="booking_id" value="<?= $row['booking_id'] ?>">
                                <button type="submit" class="cancel-button">Отменить бронь</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center; color: gray;">У вас нет активных бронирований.</p>
    <?php endif; ?>
    <div style="text-align: center; margin-top: 20px;">
    <a href="profile.php" class="button">Вернуться в личный кабинет</a>
</div>

</div>

<footer>
    &copy; <?= date('Y') ?> Показ мод. Все права защищены.
</footer>

</body>
</html>
