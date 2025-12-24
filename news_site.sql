-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 24 2025 г., 15:15
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `news_site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_text` text NOT NULL,
  `full_text` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `title`, `short_text`, `full_text`, `category`, `image`, `date`) VALUES
(2, 'Бiй Джейка Пола та Ентонi Джошуа', 'Чинний чемпіон UFC у важкій вазі (до 120 кг) британець Том Аспіналл оцінив боксерський поєдинок між екс-блогером Джейком Полом і колишнім чемпіоном світу з боксу Ентоні Джошуа.', '«Це було не дуже весело, але в цілому нормально. Все пройшло приблизно так, як я і передбачав. Я не думав, що Джейк Пол буде стояти і битися з ним спочатку, це було б просто самогубством», — сказав Аспіналл у відео для свого YouTube-каналу Tom Aspinall Official.\r\n\r\nБій між Полом і Джошуа відбувся в суботу, 20 грудня, і завершився перемогою Ей Джея в шостому раунді. 36-річний британець тепер має професійний рекорд 29-4. Рекорд 28-річного американця в професійному боксі 12-2.', 'Спорт', '1766338877_kak-mir-otreagiroval-na-boj-pola-i-dzhoshua_1766224510838145987.jpg', '2025-12-21 19:41:17');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$vDf1sqvL.oLkxPo2c1BVm.XXVbvV/c7dcqyZhzPk.o5AcxcIH7ATu', 'admin');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
