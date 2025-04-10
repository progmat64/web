<?php
session_start();
require_once 'db.php';

$whereClauses = [];
if (isset($_GET['search']) && $_GET['search'] != '') {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $whereClauses[] = "p.nazvanie LIKE '%$search%'";
}
if (isset($_GET['date']) && $_GET['date'] != '') {
    $date = mysqli_real_escape_string($conn, $_GET['date']);
    $whereClauses[] = "p.date = '$date'";
}
if (isset($_GET['place']) && $_GET['place'] != '') {
    $place = mysqli_real_escape_string($conn, $_GET['place']);
    $whereClauses[] = "p.place LIKE '%$place%'";
}
$orderBy = "p.date ASC"; 
if (isset($_GET['sort']) && $_GET['sort'] == 'desc') {
    $orderBy = "p.date DESC";
}

$whereSql = count($whereClauses) > 0 ? 'WHERE ' . implode(' AND ', $whereClauses) : '';
$sql = "SELECT  
            p.id_pokaz,
            p.nazvanie,
            p.date,
            p.time,
            p.place AS pokaz,
            s.full_name AS sotrudniki,
            i.name AS izdelie,
            m.naimenovanie AS material,
            k.nazvanie AS kategory
          FROM pokaz p
          LEFT JOIN sotrudniki s ON p.id_sotrudnik = s.id_sotrudnik
          LEFT JOIN izdelie i ON p.id_izdelia = i.id_izdelia
          LEFT JOIN material m ON i.id_material = m.id_material
          LEFT JOIN kategory k ON i.id_kotegory = k.id_kategory
          $whereSql
          ORDER BY $orderBy";

$result = mysqli_query($conn, $sql);

 if (isset($_SESSION['success_message'])): ?>
    <div class="success-message">
        <?= $_SESSION['success_message'] ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="error-message">
        <?= $_SESSION['error_message'] ?>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Бронирование | Показ мод</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .booking-container {
      padding: 40px;
      background: rgba(255, 255, 255, 0.95);
    }

    .booking-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .booking-table th, .booking-table td {
      padding: 12px 16px;
      border: 1px solid #ccc;
      text-align: center;
    }

    .booking-table th {
      background-color: #f5f5f5;
      font-weight: bold;
    }

    .booking-table tr:hover {
      background-color: #f0f0f0;
    }

    .search-form {
      margin-bottom: 20px;
      text-align: center;
    }

    .search-form input[type="text"],
    .search-form input[type="date"],
    .search-form input[type="submit"] {
      padding: 8px;
      margin: 5px;
    }

    .search-form select {
      padding: 8px;
      margin: 5px;
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

<div class="booking-container">
  <h1 style="text-align:center;">Бронирование показов</h1>

  <div class="search-form">
    <form method="GET" action="booking.php">
      <input type="text" name="search" placeholder="Поиск по названию" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
      <input type="date" name="date" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
      <input type="text" name="place" placeholder="Поиск по месту" value="<?= isset($_GET['place']) ? $_GET['place'] : '' ?>">
      <select name="sort">
        <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : '' ?>>По дате (возр.)</option>
        <option value="desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'selected' : '' ?>>По дате (уб.)</option>
      </select>
      <input type="submit" value="Фильтровать">
    </form>
  </div>

  <?php if ($result && mysqli_num_rows($result) > 0): ?>
    <form method="POST" action="book_show.php">
      <table class="booking-table">
        <thead>
          <tr>
            <th><input type="checkbox" id="select_all" onclick="toggleAllCheckboxes()">Выбрать</th>
            <th>Название показа</th>
            <th>Дата</th>
            <th>Время</th>
            <th>Место</th>
            <th>Сотрудник</th>
            <th>Изделие</th>
            <th>Материал</th>
            <th>Категория</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
              <td><input type="checkbox" name="pokaz_ids[]" value="<?= $row['id_pokaz'] ?>"></td>
              <td><?= htmlspecialchars($row['nazvanie']) ?></td>
              <td><?= date('d-m-Y', strtotime($row['date'])) ?></td>
              <td><?= htmlspecialchars($row['time']) ?></td>
              <td><?= htmlspecialchars($row['pokaz']) ?></td>
              <td><?= htmlspecialchars($row['sotrudniki']) ?></td>
              <td><?= htmlspecialchars($row['izdelie']) ?></td>
              <td><?= htmlspecialchars($row['material']) ?></td>
              <td><?= htmlspecialchars($row['kategory']) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
      <div style="text-align: center; margin-top: 20px;">
        <button type="submit">Забронировать</button>
      </div>
    </form>
  <?php else: ?>
    <p style="text-align:center; color: gray;">Показов пока нет.</p>
  <?php endif; ?>
</div>

<footer>
  &copy; <?= date('Y') ?> Показ мод. Все права защищены.
</footer>

<script>
  function toggleAllCheckboxes() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const selectAll = document.getElementById('select_all');
    checkboxes.forEach(checkbox => {
      checkbox.checked = selectAll.checked;
    });
  }
</script>

</body>
</html>
