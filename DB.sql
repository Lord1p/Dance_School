-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 25 2019 г., 02:07
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.4

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `dance_school`
--
CREATE DATABASE IF NOT EXISTS `dance_school` DEFAULT CHARACTER SET cp1251 COLLATE cp1251_general_ci;
USE `dance_school`;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `name` varchar(40) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `avatarLink` varchar(60) NOT NULL DEFAULT './avatars/admins/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `admins`
--

TRUNCATE TABLE `admins`;
--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`name`, `email`, `password`, `avatarLink`) VALUES
('Петрова Елизавета Сидоровна', 'sid.el@mail.ru', 'root', './avatars/admins/default.jpg'),
(' Костар Владислав Владиславович', 'vlad.kost@gmail.com', 'root', './avatars/admins/default.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tellNumber` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `clientId` int(11) NOT NULL,
  `avatarLink` varchar(60) NOT NULL DEFAULT './avatars/clients/default.jpg',
  `mailSending` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `clients`
--

TRUNCATE TABLE `clients`;
--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`name`, `email`, `tellNumber`, `password`, `clientId`, `avatarLink`, `mailSending`) VALUES
('олег скоромный', 'olehonator1@mail.ru', '45', '45', 14, './avatars/clients/default.jpg', b'1'),
('олег скоромный', 'olehonator2@mail.ru', '1', '1', 15, './avatars/clients/default.jpg', b'1'),
('Колода Виктория Петровна', 'coloda228@mail.ru', '123456789', '1111', 16, './avatars/clients/default.jpg', b'0');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `courseId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `countOfPlaces` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `styleId` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `courses`
--

TRUNCATE TABLE `courses`;
--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`courseId`, `name`, `teacherId`, `countOfPlaces`, `price`, `styleId`, `description`, `duration`) VALUES
(1, 'Бальные танцы для 10 классов', 1, 20, 100, 1, 'В следующем году выпускной, а вы ещё не умеете танцевать? Не отчаивайтесь, у нас вы быстро освоите бальные танцы на мастерском уровне и никто более не сможет вас упрекнуть.', 10),
(2, 'Специальное предложение!', 2, 15, 200, 2, 'Только у нас и только сейчас курс по breakdance-у от легендарной личности. Такого вы больше нигде не найдёте. Спешите предложение ограничено.', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE `lessons` (
  `lessonId` int(11) NOT NULL,
  `date` date NOT NULL,
  `courseId` int(11) NOT NULL,
  `roomID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `lessons`
--

TRUNCATE TABLE `lessons`;
-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `date` date NOT NULL,
  `header` mediumtext NOT NULL,
  `text` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `news`
--

TRUNCATE TABLE `news`;
--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`newsId`, `date`, `header`, `text`) VALUES
(1, '2019-05-24', 'У нас появился сайт!', 'Доброго всем денёчка! У нас наконец-то появился сайт! Скоро вы сможете увидеть много нового функционала на нём');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `clientId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `orders`
--

TRUNCATE TABLE `orders`;
-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `roomId` int(11) NOT NULL,
  `roomNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `rooms`
--

TRUNCATE TABLE `rooms`;
-- --------------------------------------------------------

--
-- Структура таблицы `styles`
--

DROP TABLE IF EXISTS `styles`;
CREATE TABLE `styles` (
  `styleId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `styles`
--

TRUNCATE TABLE `styles`;
--
-- Дамп данных таблицы `styles`
--

INSERT INTO `styles` (`styleId`, `name`) VALUES
(1, 'Бальные танцы'),
(2, 'Breakdance');

-- --------------------------------------------------------

--
-- Структура таблицы `trainers`
--

DROP TABLE IF EXISTS `trainers`;
CREATE TABLE `trainers` (
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tellNumber` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `description` mediumtext NOT NULL,
  `photoLink` varchar(200) NOT NULL DEFAULT './avatars/trainers/default.jpg',
  `trainerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `trainers`
--

TRUNCATE TABLE `trainers`;
--
-- Дамп данных таблицы `trainers`
--

INSERT INTO `trainers` (`name`, `email`, `tellNumber`, `password`, `description`, `photoLink`, `trainerId`) VALUES
('Иванов Иван Иванович', 'ivan.ivanich1986@gmail.com', '+380541234567', '00000000', 'Родился и вырос в городе Харьков. Обучался и истинных мастеров своего дела. Участвовал в различных конкурсах и занимал призовые места. Знает о танцах всё.', './avatars/trainers/default.jpg', 1),
('Зубенко Михаил Петрович', 'zubenko.michail@gmail.com', '2211334455', '123', 'ФИО: Зубенко Михаил Петрович.\r\nКем являетесь: Вор в законе.\r\nГде именно: Сумиловский городок.\r\nКличка: Мафиозник.', './avatars/trainers/2.jpg', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`email`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseId`),
  ADD KEY `Tid` (`teacherId`),
  ADD KEY `Sid` (`styleId`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lessonId`),
  ADD KEY `Coid` (`courseId`),
  ADD KEY `lessons_ibfk_2` (`roomID`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `Clid` (`clientId`),
  ADD KEY `Coid` (`courseId`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomId`);

--
-- Индексы таблицы `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`styleId`);

--
-- Индексы таблицы `trainers`
--
ALTER TABLE `trainers`
  ADD PRIMARY KEY (`trainerId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lessonId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `styles`
--
ALTER TABLE `styles`
  MODIFY `styleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacherId`) REFERENCES `trainers` (`trainerId`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`styleId`) REFERENCES `styles` (`styleId`);

--
-- Ограничения внешнего ключа таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`courseId`),
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `rooms` (`roomId`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`courseId`) REFERENCES `courses` (`courseId`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
