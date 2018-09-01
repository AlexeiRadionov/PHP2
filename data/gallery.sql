-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 12 2018 г., 17:56
-- Версия сервера: 5.6.38
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gallery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `id_session` text NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `id_session`, `id_product`, `quantity`) VALUES
(1, '1jl8j3lr6roikqur3tc1mkdda4', 2, 1),
(2, '1jl8j3lr6roikqur3tc1mkdda4', 13, 2),
(3, '1jl8j3lr6roikqur3tc1mkdda4', 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `text_fb` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `text_fb`, `date`) VALUES
(1, 'Вася', 'Отзыв 1', '2018-07-08 21:18:00'),
(2, 'Иван', 'Отзыв 2', '2018-07-08 21:18:35'),
(3, 'Алексей', 'Отзыв 3', '2018-07-08 21:22:14'),
(4, 'Сергей', 'Отзыв 4', '2018-07-09 13:28:56');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  `path_img` text NOT NULL,
  `count_preview` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `id_image`, `path_img`, `count_preview`, `description`, `price`) VALUES
(1, 1, '01.jpg', 29, 'Описание товара 1', '50000.00'),
(2, 2, '02.jpg', 60, 'Описание товара 2', '75000.00'),
(3, 3, '03.jpg', 36, 'Описание товара 3', '199000.90'),
(4, 4, '04.jpg', 30, 'Описание товара 4', '999.99'),
(5, 5, '05.jpg', 18, 'Описание товара 5', '1000.01'),
(6, 6, '06.jpg', 41, 'Описание товара 6', '1000000.00'),
(7, 7, '07.jpg', 17, 'Описание товара 7', '150000.00'),
(8, 8, '08.jpg', 5, 'Описание товара 8', '10000000.00'),
(9, 9, '09.jpg', 38, 'Описание товара 9', '35000.00'),
(10, 10, '10.jpg', 18, 'Описание товара 10', '99999.99'),
(11, 11, '11.jpg', 22, 'Описание товара 11', '350500.00'),
(12, 12, '12.jpg', 18, 'Описание товара 12', '7800.00'),
(13, 13, '13.jpg', 23, 'Описание товара 13', '4000000.00'),
(14, 14, '14.jpg', 13, 'Описание товара 14', '140900.00'),
(15, 15, '15.jpg', 29, 'Описание товара 15', '55700.00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
