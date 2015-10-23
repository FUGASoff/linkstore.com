-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 21 2015 г., 14:37
-- Версия сервера: 5.5.44-0ubuntu0.14.04.1
-- Версия PHP: 5.5.9-1ubuntu4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `linkstore`
--

-- --------------------------------------------------------

--
-- Структура таблицы `activation`
--

CREATE TABLE `activation` (
  `act_id` int(11) NOT NULL,
  `user_Id` int(11) NOT NULL,
  `hash` varchar(33) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `link`
--

CREATE TABLE `link` (
  `link_id` int(11) NOT NULL,
  `link_address` text NOT NULL,
  `link_name` text NOT NULL,
  `link_description` text NOT NULL,
  `type` tinyint(1) NOT NULL,
  `user_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `link`
--

INSERT INTO `link` (`link_id`, `link_address`, `link_name`, `link_description`, `type`, `user_Id`) VALUES
(5, 'linkstore.com', 'Link Store', 'Save your links', 1, 6),
(6, 'linkstore.com', 'Link Store', 'Save your links', 0, 6),
(7, 'rwedrf', 'rwe', 'wer', 0, 6),
(8, 'rwedrf', 'rwe', 'wer', 0, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_code` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_title` varchar(10) NOT NULL,
  `role_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`role_id`, `role_title`, `role_code`) VALUES
(1, 'admin', 1),
(2, 'editor', 2),
(3, 'user', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_Id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(80) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '3',
  `user_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_Id`, `user_name`, `user_email`, `user_password`, `role_id`, `user_status`) VALUES
(6, 'test', 'Dr-FUGASoff@yandex.ru', 'bb03e43ffe34eeb242a2ee4a4f125e56', 3, 0),
(29, 'fugas', 'Dr-FUGASoff@yandex.ru', 'bb03e43ffe34eeb242a2ee4a4f125e56', 3, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `activation`
--
ALTER TABLE `activation`
  ADD PRIMARY KEY (`act_id`);

--
-- Индексы таблицы `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `link_id` (`link_id`),
  ADD KEY `link_id_2` (`link_id`,`user_Id`),
  ADD KEY `user_Id` (`user_Id`);

--
-- Индексы таблицы `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `permission_id` (`permission_id`,`role_id`,`permission_code`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD KEY `role_id` (`role_id`,`role_title`,`role_code`),
  ADD KEY `role_id_2` (`role_id`,`role_title`,`role_code`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_Id`),
  ADD KEY `user_Id` (`user_Id`),
  ADD KEY `user_Id_2` (`user_Id`),
  ADD KEY `user_Id_3` (`user_Id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `activation`
--
ALTER TABLE `activation`
  MODIFY `act_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `link`
--
ALTER TABLE `link`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `link`
--
ALTER TABLE `link`
  ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `user` (`user_Id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
