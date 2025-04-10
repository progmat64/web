-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 06 2025 г., 01:01
-- Версия сервера: 5.7.33-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `matveev`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pokaz_id` int(11) NOT NULL,
  `booking_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `pokaz_id`, `booking_date`) VALUES
(1, 3, 1, '2025-04-05 21:31:53'),
(7, 3, 2, '2025-04-05 21:56:26'),
(9, 3, 3, '2025-04-05 21:56:26');

-- --------------------------------------------------------

--
-- Структура таблицы `izdelie`
--

CREATE TABLE `izdelie` (
  `id_izdelia` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `price` int(11) DEFAULT NULL,
  `id_material` int(11) NOT NULL,
  `id_kotegory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `izdelie`
--

INSERT INTO `izdelie` (`id_izdelia`, `name`, `price`, `id_material`, `id_kotegory`) VALUES
(1, 'Вечер', 256000, 1, 1),
(2, 'Утро', 2500, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `kategory`
--

CREATE TABLE `kategory` (
  `id_kategory` int(11) NOT NULL,
  `nazvanie` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `kategory`
--

INSERT INTO `kategory` (`id_kategory`, `nazvanie`) VALUES
(1, 'Шорты'),
(2, 'Футболка');

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `naimenovanie` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id_material`, `naimenovanie`) VALUES
(1, 'Кожа'),
(2, 'Хлопок');

-- --------------------------------------------------------

--
-- Структура таблицы `pokaz`
--

CREATE TABLE `pokaz` (
  `id_pokaz` int(11) NOT NULL,
  `nazvanie` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `place` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `id_izdelia` int(11) NOT NULL,
  `id_sotrudnik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pokaz`
--

INSERT INTO `pokaz` (`id_pokaz`, `nazvanie`, `date`, `time`, `place`, `image`, `id_izdelia`, `id_sotrudnik`) VALUES
(1, 'TrueHouse', '2025-03-05', '12:00:00', 'Площадь Ленина', '1.jpg', 1, 1),
(2, 'BishBashBosh', '2025-03-03', '10:00:00', 'Фонтан \"Брызги\"', '2.jpg', 1, 1),
(3, 'Flex Glex', '2025-04-10', '12:00:00', 'Общага', 'gal3.jpg', 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `sotrudniki`
--

CREATE TABLE `sotrudniki` (
  `id_sotrudnik` int(11) NOT NULL,
  `full_name` text COLLATE utf8mb4_unicode_ci,
  `zp` int(11) DEFAULT NULL,
  `stazh` int(11) DEFAULT NULL,
  `dolzhnost` text COLLATE utf8mb4_unicode_ci,
  `login` text COLLATE utf8mb4_unicode_ci,
  `password` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `sotrudniki`
--

INSERT INTO `sotrudniki` (`id_sotrudnik`, `full_name`, `zp`, `stazh`, `dolzhnost`, `login`, `password`) VALUES
(1, 'Колотилин Владими Владимирович', 20000, 1, 'Заместитель начальника отдела №3 туалетного обеспечения', 'chetirkarulit', 'oformitecarti25'),
(2, 'Солькулев Михаил Федерович', 52000, 5, 'Старший', 'log', '123');

-- --------------------------------------------------------

--
-- Структура таблицы `zakazchiki`
--

CREATE TABLE `zakazchiki` (
  `id_zakazchiki` int(11) NOT NULL,
  `fio` text COLLATE utf8mb4_unicode_ci,
  `phone` text COLLATE utf8mb4_unicode_ci,
  `date_rozd` date NOT NULL,
  `pasport` text COLLATE utf8mb4_unicode_ci,
  `email` text COLLATE utf8mb4_unicode_ci,
  `adress` text COLLATE utf8mb4_unicode_ci,
  `login` text COLLATE utf8mb4_unicode_ci,
  `password` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `zakazchiki`
--

INSERT INTO `zakazchiki` (`id_zakazchiki`, `fio`, `phone`, `date_rozd`, `pasport`, `email`, `adress`, `login`, `password`) VALUES
(1, 'Авдеев Александр Васильевич', '9214563199', '2019-03-06', NULL, 'gamer22@mail.ru', 'г.Санкт-Петербург, ул. Маршала Казакова, д.22, кв.412', 'ludbluhevika', '12345679'),
(2, 'Жданов Егор Васильевич', '9504327784', '2016-12-02', NULL, 'egorzdanov@yandex.ru', 'г. Санкт-Петербург, ул. Умного, д.52, кв.33', 'egogogo', 'qwertyuiopasdf'),
(3, 'dsfdsf', '+79221445862', '2025-04-04', 'sadasdsad', 'dfsdsf@list.ru', 'dsfsdfdsf', 'l1ppy', '$2y$10$L6zhvB3rs0yzb9RR/Aqv7uqeE6oxgL9eZp4eSKx0d8CSD0cYetre2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pokaz_id` (`pokaz_id`);

--
-- Индексы таблицы `izdelie`
--
ALTER TABLE `izdelie`
  ADD PRIMARY KEY (`id_izdelia`),
  ADD KEY `id_kotegory` (`id_kotegory`),
  ADD KEY `id_material` (`id_material`);

--
-- Индексы таблицы `kategory`
--
ALTER TABLE `kategory`
  ADD PRIMARY KEY (`id_kategory`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Индексы таблицы `pokaz`
--
ALTER TABLE `pokaz`
  ADD PRIMARY KEY (`id_pokaz`),
  ADD KEY `id_izdelia` (`id_izdelia`),
  ADD KEY `id_sotrudnik` (`id_sotrudnik`);

--
-- Индексы таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  ADD PRIMARY KEY (`id_sotrudnik`);

--
-- Индексы таблицы `zakazchiki`
--
ALTER TABLE `zakazchiki`
  ADD PRIMARY KEY (`id_zakazchiki`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `izdelie`
--
ALTER TABLE `izdelie`
  MODIFY `id_izdelia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `kategory`
--
ALTER TABLE `kategory`
  MODIFY `id_kategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `pokaz`
--
ALTER TABLE `pokaz`
  MODIFY `id_pokaz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `sotrudniki`
--
ALTER TABLE `sotrudniki`
  MODIFY `id_sotrudnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `zakazchiki`
--
ALTER TABLE `zakazchiki`
  MODIFY `id_zakazchiki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `zakazchiki` (`id_zakazchiki`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`pokaz_id`) REFERENCES `pokaz` (`id_pokaz`);

--
-- Ограничения внешнего ключа таблицы `izdelie`
--
ALTER TABLE `izdelie`
  ADD CONSTRAINT `izdelie_ibfk_1` FOREIGN KEY (`id_kotegory`) REFERENCES `kategory` (`id_kategory`),
  ADD CONSTRAINT `izdelie_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`);

--
-- Ограничения внешнего ключа таблицы `pokaz`
--
ALTER TABLE `pokaz`
  ADD CONSTRAINT `pokaz_ibfk_1` FOREIGN KEY (`id_izdelia`) REFERENCES `izdelie` (`id_izdelia`),
  ADD CONSTRAINT `pokaz_ibfk_3` FOREIGN KEY (`id_sotrudnik`) REFERENCES `sotrudniki` (`id_sotrudnik`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
