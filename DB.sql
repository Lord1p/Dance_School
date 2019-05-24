-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 24 2019 г., 21:10
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.4

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
CREATE TABLE IF NOT EXISTS `admins` (
  `name` varchar(40) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `avatarLink` varchar(60) NOT NULL DEFAULT './avatars/admins/default.jpg',
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `admins`
--

TRUNCATE TABLE `admins`;
-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tellNumber` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `clientId` int(11) NOT NULL AUTO_INCREMENT,
  `avatarLink` varchar(60) NOT NULL DEFAULT './avatars/clients/default.jpg',
  `mailSending` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`clientId`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `clients`
--

TRUNCATE TABLE `clients`;
-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `courseId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `teacherId` int(11) NOT NULL,
  `countOfPlaces` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `styleId` int(11) NOT NULL,
  `description` mediumtext NOT NULL,
  `duration` int(11) NOT NULL,
  PRIMARY KEY (`courseId`),
  KEY `Tid` (`teacherId`),
  KEY `Sid` (`styleId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `courses`
--

TRUNCATE TABLE `courses`;
--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`courseId`, `name`, `teacherId`, `countOfPlaces`, `price`, `styleId`, `description`, `duration`) VALUES
(1, 'Бальные танцы для 10 классов', 1, 20, 100, 1, 'В следующем году выпускной, а вы ещё не умеете танцевать? Не отчаивайтесь, у нас вы быстро освоите бальные танцы на мастерском уровне и никто более не сможет вас упрекнуть.', 10);

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE IF NOT EXISTS `lessons` (
  `lessonId` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `courseId` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  PRIMARY KEY (`lessonId`),
  KEY `Coid` (`courseId`),
  KEY `lessons_ibfk_2` (`roomID`)
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
CREATE TABLE IF NOT EXISTS `news` (
  `newsId` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `header` mediumtext NOT NULL,
  `text` mediumtext NOT NULL,
  PRIMARY KEY (`newsId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

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
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `clientId` int(11) NOT NULL,
  `courseId` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  PRIMARY KEY (`orderId`),
  KEY `Clid` (`clientId`),
  KEY `Coid` (`courseId`)
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
CREATE TABLE IF NOT EXISTS `rooms` (
  `roomId` int(11) NOT NULL AUTO_INCREMENT,
  `roomNumber` int(11) NOT NULL,
  PRIMARY KEY (`roomId`)
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
CREATE TABLE IF NOT EXISTS `styles` (
  `styleId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`styleId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `styles`
--

TRUNCATE TABLE `styles`;
--
-- Дамп данных таблицы `styles`
--

INSERT INTO `styles` (`styleId`, `name`) VALUES
(1, 'Бальные танцы');

-- --------------------------------------------------------

--
-- Структура таблицы `trainers`
--

DROP TABLE IF EXISTS `trainers`;
CREATE TABLE IF NOT EXISTS `trainers` (
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tellNumber` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `description` mediumtext NOT NULL,
  `photoLink` varchar(200) NOT NULL DEFAULT './avatars/trainers/default.jpg',
  `trainerId` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`trainerId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `trainers`
--

TRUNCATE TABLE `trainers`;
--
-- Дамп данных таблицы `trainers`
--

INSERT INTO `trainers` (`name`, `email`, `tellNumber`, `password`, `description`, `photoLink`, `trainerId`) VALUES
('Иванов Иван Иванович', 'ivan.ivanich1986@gmail.com', '+380541234567', '00000000', 'Родился и вырос в городе Харьков. Обучался и истинных мастеров своего дела. Участвовал в различных конкурсах и занимал призовые места. Знает о танцах всё.', './avatars/trainers/default.jpg', 1);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
