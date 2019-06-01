-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 01 2019 г., 20:02
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
  `adminName` varchar(40) NOT NULL,
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

INSERT INTO `admins` (`adminName`, `email`, `password`, `avatarLink`) VALUES
('Петрова Елизавета Сидоровна', 'sid.el@mail.ru', 'root', './avatars/admins/default.jpg'),
('Григорий Стицько', 'stic.grig@gmail.com', '456456456', './avatars/admins/default.jpg'),
(' Костар Владислав Владиславович', 'vlad.kost@gmail.com', 'root', './avatars/admins/default.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `clientName` varchar(100) NOT NULL,
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

INSERT INTO `clients` (`clientName`, `email`, `tellNumber`, `password`, `clientId`, `avatarLink`, `mailSending`) VALUES
('олег скоромный', 'olehonator1@mail.ru', '45', '45', 14, './avatars/clients/default.jpg', b'1'),
('олег скоромный', 'olehonator2@mail.ru', '1', '1', 15, './avatars/clients/default.jpg', b'1'),
('Колода Виктория Петровна', 'coloda228@mail.ru', '123456789', '1111', 16, './avatars/clients/default.jpg', b'0'),
('1 1', '1@1', '1111', '1', 18, './avatars/clients/default.jpg', b'1'),
('789789 456456', '4564564564@1231231', '7897897897897', '1123123123', 19, './avatars/clients/default.jpg', b'1');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `courseId` int(11) NOT NULL,
  `courseName` varchar(100) NOT NULL,
  `trainerId` int(11) NOT NULL,
  `countOfPlaces` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `styleId` int(11) NOT NULL,
  `courseDescription` mediumtext NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `courses`
--

TRUNCATE TABLE `courses`;
--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`courseId`, `courseName`, `trainerId`, `countOfPlaces`, `price`, `styleId`, `courseDescription`, `duration`) VALUES
(1, 'Бальные танцы для 10 классов', 1, 20, 100, 1, 'В следующем году выпускной, а вы ещё не умеете танцевать? Не отчаивайтесь, у нас вы быстро освоите бальные танцы на мастерском уровне и никто более не сможет вас упрекнуть.', 10),
(2, 'Специальное предложение!', 2, 15, 200, 2, 'Только у нас и только сейчас курс по breakdance-у от легендарной личности. Такого вы больше нигде не найдёте. Спешите предложение ограничено.', 10),
(3, 'Лунная походка от первооткрывателя!', 3, 30, 400, 7, 'Изучайте лунную походку от самого Майкла Джексона. Незабываемый танец от незабываемой личности! Только у нас и только сейчас вы можете записаться на этот курс. Успейте пока ещё есть места.', 15),
(4, 'Гопак от главы Киева!', 4, 10, 350, 17, 'Не только лишь все могут пойти на этот курс. Мало кто может это сделать. Виталий Кличко специально изучил гопак, чтобы преподавать его у нас. Успейте пока действует предложение.', 15),
(5, 'Научись танцевать как робот у настоящего робота!', 5, 25, 375, 9, '\"Самый современный\" российский робот передислоцировался к нам, сообщив о желании обучать танцам. В связи с этим событием мы открываем набор на курс по стилю робот. Научись танцевать как робот, чтобы спастись во время восстания машин. Предложение ограничено!', 15);

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

DROP TABLE IF EXISTS `lessons`;
CREATE TABLE `lessons` (
  `lessonId` int(11) NOT NULL,
  `date` date NOT NULL,
  `courseId` int(11) NOT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `lessons`
--

TRUNCATE TABLE `lessons`;
--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`lessonId`, `date`, `courseId`, `roomId`) VALUES
(1, '2019-07-01', 3, 1),
(2, '2019-07-03', 3, 1),
(3, '2019-07-05', 3, 2),
(4, '2019-07-08', 3, 4),
(5, '2019-07-10', 3, 7),
(6, '2019-07-12', 3, 9),
(7, '2019-07-15', 3, 2),
(8, '2019-07-17', 3, 1),
(9, '2019-07-19', 3, 2),
(10, '2019-07-29', 3, 5),
(11, '2019-07-31', 3, 2),
(12, '2019-08-02', 3, 1),
(13, '2019-08-05', 3, 3),
(14, '2019-08-07', 3, 5),
(15, '2019-08-09', 3, 9);

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
(1, '2019-05-24', 'У нас появился сайт!', 'Доброго всем денёчка! У нас наконец-то появился сайт! Скоро вы сможете увидеть много нового функционала на нём'),
(2, '2019-05-28', 'Мы расширились!', 'Ассортимент комнат увеличился! Ожидайте много новых захватывающих курсов.'),
(3, '2019-05-30', 'Новые курсы!!!', 'К нам приехали гости из-за границы, а также киевский глава, чтобы обучать вас танцам. Успевайте пока не поздно записаться на наши новые курсы. Новые курсы по стилям: робот, гопак, лунная походка.'),
(4, '2019-06-01', 'Новый месяц!', 'Новый месяц, а вы ещё не записались на курс? Спешите ухватить такую возможность, пока можете, а то будете жалеть.'),
(5, '2019-06-03', 'Мы укрепили крышу.', 'В ближайшее время синоптики обещают частые ливни. Во избежание проблем связанных с этим мы заблаговременно укрепили крышу. Теперь можете не переживать, что занятие не состоится из-за погодных условий!'),
(6, '2019-06-06', 'Райское наслаждение!', 'Мы закончили установку кондиционеров в каждой комнате. Теперь приходя на занятия вам не нужно переживать о жаре!'),
(7, '2019-06-10', 'Буфет!', 'В здании школы начал свою работу буфет. Теперь вы можете восстановить силы сразу после занятия. Ассортимент довольно велик!');

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
--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`orderId`, `clientId`, `courseId`, `code`) VALUES
(1, 16, 4, 'DGMN2334'),
(2, 18, 3, 'DYTN2761'),
(3, 18, 5, 'GEVX5134');

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
--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`roomId`, `roomNumber`) VALUES
(1, 101),
(2, 102),
(3, 103),
(4, 104),
(5, 105),
(6, 106),
(7, 107),
(8, 108),
(9, 109),
(10, 110),
(11, 201),
(12, 202),
(13, 203),
(14, 204),
(15, 205),
(16, 206),
(17, 207),
(18, 208),
(19, 209),
(20, 210),
(21, 301),
(22, 302),
(23, 303),
(24, 304);

-- --------------------------------------------------------

--
-- Структура таблицы `styles`
--

DROP TABLE IF EXISTS `styles`;
CREATE TABLE `styles` (
  `styleId` int(11) NOT NULL,
  `styleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `styles`
--

TRUNCATE TABLE `styles`;
--
-- Дамп данных таблицы `styles`
--

INSERT INTO `styles` (`styleId`, `styleName`) VALUES
(1, 'Бальные танцы'),
(2, 'Брейкданс'),
(3, 'Сальса'),
(4, 'Фламенко'),
(5, 'Восточный танец'),
(6, 'Тектоник'),
(7, 'Лунная походка'),
(8, 'Диско'),
(9, 'Робот'),
(10, 'Самба'),
(11, 'Румба'),
(12, 'Ламбада'),
(13, 'Танго'),
(14, 'Медленный вальс'),
(15, 'Лезгинка'),
(16, 'Полька'),
(17, 'Гопак');

-- --------------------------------------------------------

--
-- Структура таблицы `trainers`
--

DROP TABLE IF EXISTS `trainers`;
CREATE TABLE `trainers` (
  `trainerName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tellNumber` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `trainerDescription` mediumtext NOT NULL,
  `avatarLink` varchar(200) NOT NULL DEFAULT './avatars/trainers/default.jpg',
  `trainerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Очистить таблицу перед добавлением данных `trainers`
--

TRUNCATE TABLE `trainers`;
--
-- Дамп данных таблицы `trainers`
--

INSERT INTO `trainers` (`trainerName`, `email`, `tellNumber`, `password`, `trainerDescription`, `avatarLink`, `trainerId`) VALUES
('Иванов Иван ', 'ivan.ivanich1986@gmail.com', '+380541234567', '00000000', 'Обучался и истинных мастеров своего дела. Участвовал в различных конкурсах и занимал призовые места.', './avatars/trainers/default.jpg', 1),
('Зубенко Михаил', 'zubenko.michail@gmail.com', '2211334455', '123', 'ФИО: Зубенко Михаил Петрович.\r\nКем являетесь: Вор в законе.\r\nГде именно: Сумиловский городок.\r\nКличка: Мафиозник.', './avatars/trainers/2.jpg', 2),
('Майкл Джексон', 'mail.djeck@gmail.com', '1233123123', 'billyJean', 'Американский певец, автор песен, музыкальный продюсер, аранжировщик, танцор, хореограф, актёр, сценарист, филантроп, предприниматель. ', './avatars/trainers/3.gif', 3),
('Виталий Кличко', 'klichko.v.kyiv@gmail.com', '789456123', 'NeTolkoLishVse', 'Украинский государственный деятель, политик. Член Международного зала боксёрской славы.', './avatars/trainers/4.jpg', 4),
('Робот Борис', 'boris@robot.ru', '001001001', 'KozanieUblydki', 'Робот сообщил, что знает математику и имеет танцевальные навыки, но хотел бы научиться рисовать и писать музыку.\r\n', './avatars/trainers/5.jpg', 5);

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
  ADD KEY `Tid` (`trainerId`),
  ADD KEY `Sid` (`styleId`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`lessonId`),
  ADD KEY `Coid` (`courseId`),
  ADD KEY `lessons_ibfk_2` (`roomId`);

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
  MODIFY `clientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `lessonId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `styles`
--
ALTER TABLE `styles`
  MODIFY `styleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `trainers`
--
ALTER TABLE `trainers`
  MODIFY `trainerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`trainerId`) REFERENCES `trainers` (`trainerId`),
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`styleId`) REFERENCES `styles` (`styleId`);

--
-- Ограничения внешнего ключа таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`courseId`) REFERENCES `courses` (`courseId`),
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`roomID`) REFERENCES `rooms` (`roomId`),
  ADD CONSTRAINT `lessons_ibfk_3` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`roomId`);

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
