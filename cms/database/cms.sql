-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 15 2025 г., 16:34
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
-- База данных: `cms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_content` text DEFAULT NULL,
  `status` enum('oczekujący','zaakceptowany','niezaakceptowany') DEFAULT 'oczekujący',
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment_content`, `status`, `date`) VALUES
(2, 31, 1, 'w9er9uhwep9iruhgweoripugh', 'oczekujący', '2025-12-12 19:30:05'),
(3, 31, 1, 'w9er9uhwep9iruhgweoripugh', 'oczekujący', '2025-12-12 19:30:34'),
(25, NULL, 31, 'qwerqwer', 'oczekujący', '2025-12-12 20:14:33'),
(26, 31, 1, 'qwerqwer', 'oczekujący', '2025-12-12 20:16:01'),
(27, 31, 1, '1234123412341', 'oczekujący', '2025-12-12 20:16:05'),
(28, 31, 1, '1234123412341', 'oczekujący', '2025-12-12 20:16:52'),
(29, 31, 1, '1234123412341', 'oczekujący', '2025-12-12 20:18:55'),
(30, 31, 1, '1234123412341', 'oczekujący', '2025-12-12 20:19:24'),
(31, 31, 1, '1234123412341', 'oczekujący', '2025-12-12 20:20:21');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` enum('oczekujący','zaakceptowany','niezaakceptowany') DEFAULT 'oczekujący',
  `date` datetime DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `status`, `date`, `image`) VALUES
(17, 1, 'qwer', 'qwerqwerqwer', 'zaakceptowany', '2025-12-10 14:41:47', NULL),
(18, 1, 'йцукйцук', 'йцукйцукйцук', 'zaakceptowany', '2025-12-11 14:15:46', '1765458946_Zrzut ekranu 2025-09-07 222735.png'),
(19, 1, 'To jest kolejny post', '1231231231rfqewrwer`123`234', 'zaakceptowany', '2025-12-11 14:22:42', '1765459362_Zrzut ekranu 2025-09-07 222742.png'),
(20, 1, 'qwerqwer', 'edfgqwertqawdcfaset', 'niezaakceptowany', '2025-12-11 15:04:37', NULL),
(21, 1, '1', '111111111111111111', 'zaakceptowany', '2025-12-11 16:07:00', NULL),
(22, 1, '2', '22222222222222222222222222222', 'zaakceptowany', '2025-12-11 16:07:04', NULL),
(23, 1, '3', '33333333333333333333333', 'zaakceptowany', '2025-12-11 16:07:07', NULL),
(24, 1, '4', '444444444444444444444', 'zaakceptowany', '2025-12-11 16:07:11', NULL),
(25, 1, '5', '5555555555555555555555', 'zaakceptowany', '2025-12-11 16:07:14', NULL),
(26, 1, '6', '6', 'zaakceptowany', '2025-12-11 16:07:17', NULL),
(27, 1, '7', '777777777777777777777', 'zaakceptowany', '2025-12-11 16:07:20', NULL),
(28, 1, '8', '888888888888888888', 'zaakceptowany', '2025-12-11 16:07:23', NULL),
(29, 1, '12341234', '12341234123412341234', 'zaakceptowany', '2025-12-11 16:12:06', NULL),
(30, 1, 'jeszcze raz', 'wer9oi9otj2hq9tg58ghq459[tghq[9orguvhbq3p94tg5hn34[9t08hq34j', 'niezaakceptowany', '2025-12-12 18:28:04', NULL),
(31, 1, 'qwerqwerqwer', 'qwerqewrrqoiehrvqlonihvowuihtw8gh9pnbeviutrhgjnovpbiweughjvwopiruhvwopergbwopeyrgwophvnwoebnvweuvnwehv gweiurtw9nhvwilerugwheo9rgchwneorgwhre09ghewroiugwe9r8ghnioweurghvw87gw09ughtbuiweytghwieughqwoieughweorugheuoihrgvwierutweiwqurgtvw7tw9fghnwoie7ytq98vfwoqie7rytw98courhgkwufdhvpwoeh9tqeijfpowuhgw0r9e8uteirjgpoquyehg098wet9uriwieojuhg', 'zaakceptowany', '2025-12-12 18:28:25', NULL),
(32, 1, 'qerw', 'qwerqwer', 'niezaakceptowany', '2025-12-12 19:07:16', NULL),
(33, 1, 'qrqwreqwe', 'qwerqwerq', 'niezaakceptowany', '2025-12-12 19:16:43', NULL),
(34, 1, 'we5y3wetwert', 'wertwertwertwer', 'oczekujący', '2025-12-12 19:34:34', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `added` datetime NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `added`, `foto`, `admin`) VALUES
(1, 'daniel', '$2y$10$RiYZcamFW7fRDhYjFATm9.OW3r/PzHi53MQqndB1rU9UwX0wCl6Ii', 'danilabondar2016@gmail.com', '2025-11-19 16:24:30', 'uploads/Zrzut ekranu 2025-10-21 111128.png', 1),
(2, 'marian', '$2y$10$D6hZRrp6OiHBVvy47h.z0uBfF63K2hNARyRJhpA2CBkTk/Y9pEGuC', 'marian@gmail.com', '2025-11-20 15:54:42', 'uploads/Zrzut ekranu 2025-09-07 222742.png', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
