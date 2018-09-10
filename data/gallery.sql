-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 10 2018 г., 10:46
-- Версия сервера: 5.7.20
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
  `id_basket` int(11) NOT NULL,
  `id_session` text NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id_basket`, `id_session`, `id_product`, `quantity`) VALUES
(3, 'cpq9o34gk5arqa2rbhqdbdkak2', 1, 1),
(5, 'uje29qu4nclk1ggprm332fe6r0', 3, 1),
(16, 'l355b20eli2iv041m9uvcfu041', 2, 1),
(17, 'l355b20eli2iv041m9uvcfu041', 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `name` text NOT NULL,
  `text_fb` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `name`, `text_fb`, `date`) VALUES
(1, 'Вася', 'Отзыв 1', '2018-07-08 21:18:00'),
(2, 'Иван', 'Отзыв 2', '2018-07-08 21:18:35'),
(3, 'Алексей', 'Отзыв 3', '2018-07-08 21:22:14'),
(4, 'Степан', 'Отзыв 4', '2018-09-09 20:08:02');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `path_img` text NOT NULL,
  `count_preview` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_image`, `path_img`, `count_preview`, `description`, `price`) VALUES
(1, '01.jpg', 2, 'Описание товара 1', '50000.00'),
(2, '02.jpg', 4, 'Описание товара 2', '75000.00'),
(3, '03.jpg', 1, 'Описание товара 3', '199000.90'),
(4, '04.jpg', 4, 'Описание товара 4', '999.99'),
(5, '05.jpg', 9, 'Описание товара 5', '1000.01'),
(6, '06.jpg', 0, 'Описание товара 6', '1000000.00'),
(7, '07.jpg', 2, 'Описание товара 7', '150000.00'),
(8, '08.jpg', 0, 'Описание товара 8', '10000000.00'),
(9, '09.jpg', 1, 'Описание товара 9', '35000.00'),
(10, '10.jpg', 0, 'Описание товара 10', '99999.99'),
(11, '11.jpg', 0, 'Описание товара 11', '350500.00'),
(12, '12.jpg', 1, 'Описание товара 12', '7800.00'),
(13, '13.jpg', 0, 'Описание товара 13', '4000000.00'),
(14, '14.jpg', 0, 'Описание товара 14', '140900.00'),
(15, '15.jpg', 0, 'Описание товара 15', '55700.00');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_session` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` text NOT NULL,
  `count` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_session`, `id_user`, `status`, `count`, `amount`, `date`) VALUES
(1, 'l355b20eli2iv041m9uvcfu041', 2, 'В обработке', 3, '335000.00', '2018-09-10 10:37:25'),
(2, 'l355b20eli2iv041m9uvcfu041', 3, 'В обработке', 2, '76000.01', '2018-09-10 10:41:50');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `login` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `login`, `password`, `email`) VALUES
(1, 'admin', '123', ''),
(2, 'user1', 'pass1', 'email1'),
(3, 'user2', 'pass2', 'email2'),
(4, 'user3', 'pass3', 'email3');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id_basket`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id_basket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
