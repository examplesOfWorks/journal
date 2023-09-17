-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 19 2023 г., 14:29
-- Версия сервера: 5.7.27-30-log
-- Версия PHP: 8.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `anbr1mailr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', 1, 1677519994),
('head_teacher', 138, 1684148148),
('head_of_department', 139, 1684150919),
('head_of_department', 140, 1684151218),
('teacher', 141, 1684153720),
('teacher', 142, 1684154481),
('student', 143, 1684154673),
('student', 144, 1684154823),
('student', 145, 1684154995),
('student', 146, 1684155316),
('student', 147, 1684155590),
('student', 148, 1684155728),
('parent_of_student', 149, 1684156056),
('student', 155, 1686265104),
('student', 156, 1686265200),
('student', 157, 1686265309),
('student', 158, 1686265420),
('student', 159, 1686265501),
('student', 160, 1686265609),
('student', 161, 1686265717),
('student', 162, 1686265836),
('student', 163, 1686318860),
('student', 164, 1686318963),
('student', 165, 1686319103),
('student', 166, 1686319230),
('student', 167, 1686319322),
('student', 168, 1686319449),
('student', 169, 1686320332),
('student', 170, 1686320423),
('student', 171, 1686320506),
('student', 172, 1686320613),
('student', 173, 1686321106);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `role_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `role_name`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Администратор', 'Администратор', NULL, NULL, 1674469079, 1674469079),
('canAddInfo', 2, 'Размещение расписания звонков, учебных занятий и справочной информации', '', NULL, NULL, 1674469079, 1674469079),
('canAdmin', 2, 'Администрирование системы', '', NULL, NULL, 1674469079, 1674469079),
('canManageProcess', 2, 'Ведение организации учебного процесса', '', NULL, NULL, 1674469079, 1674469079),
('canTeaching', 2, 'Преподавательская деятельность', '', NULL, NULL, 1674469079, 1674469079),
('canViewMarksAndAttendance', 2, 'Просмотр оценок и посещаемости', '', NULL, NULL, 1674469079, 1674469079),
('head_of_department', 1, 'Заведующий отделением', 'Заведующий отделением', NULL, NULL, 1674469079, 1674469079),
('head_teacher', 1, 'Завуч', 'Завуч', NULL, NULL, 1674469079, 1674469079),
('parent_of_student', 1, 'Родитель', 'Родитель', NULL, NULL, 1674469079, 1674469079),
('student', 1, 'Студент', 'Студент', NULL, NULL, 1674469079, 1674469079),
('teacher', 1, 'Учитель', 'Учитель', NULL, NULL, 1674469079, 1674469079);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('head_teacher', 'canAddInfo'),
('admin', 'canAdmin'),
('head_of_department', 'canManageProcess'),
('head_teacher', 'canManageProcess'),
('teacher', 'canTeaching'),
('parent_of_student', 'canViewMarksAndAttendance'),
('student', 'canViewMarksAndAttendance'),
('admin', 'head_teacher');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE `department` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `user_id`, `title`) VALUES
(5, 139, 'Информационнные системы и программирование'),
(6, 140, 'Сетевое и системное администрирование');

-- --------------------------------------------------------

--
-- Структура таблицы `gender`
--

CREATE TABLE `gender` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gender`
--

INSERT INTO `gender` (`id`, `title`) VALUES
(1, 'мужской'),
(2, 'женский');

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `id` int(10) UNSIGNED NOT NULL,
  `specialty_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `specialty_id`, `title`) VALUES
(9, 8, 'ПР-1'),
(10, 9, 'ВР-1'),
(11, 10, 'С-Адм-1'),
(23, 8, 'ПР-2'),
(24, 9, 'ВР-2');

-- --------------------------------------------------------

--
-- Структура таблицы `mark`
--

CREATE TABLE `mark` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `lesson_id` int(10) UNSIGNED NOT NULL,
  `mark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mark`
--

INSERT INTO `mark` (`id`, `student_id`, `lesson_id`, `mark`) VALUES
(37, 10, 33, 'н'),
(39, 9, 35, '4'),
(40, 10, 35, '5'),
(41, 5, 29, 'б'),
(42, 5, 30, 'б'),
(43, 6, 29, '4'),
(44, 5, 31, '3'),
(45, 6, 32, '4'),
(47, 7, 21, '5'),
(48, 7, 22, '4'),
(49, 8, 21, 'н'),
(50, 7, 23, '3'),
(51, 8, 24, '5'),
(52, 8, 25, '4'),
(53, 8, 26, '4'),
(56, 10, 36, '3'),
(57, 7, 24, '4'),
(59, 10, 46, '4'),
(60, 9, 46, '5'),
(61, 9, 42, '4'),
(62, 10, 41, '5'),
(64, 10, 39, '4'),
(65, 9, 44, '5'),
(67, 9, 37, '4'),
(68, 10, 38, '4'),
(69, 10, 45, '4'),
(72, 9, 43, '4'),
(73, 9, 34, '4'),
(74, 9, 36, '4'),
(75, 9, 40, '5'),
(76, 9, 48, '5'),
(77, 10, 49, '3'),
(78, 14, 49, 'н'),
(79, 10, 52, '4'),
(80, 9, 50, 'н'),
(81, 14, 51, '4'),
(82, 15, 49, '5'),
(83, 15, 51, '4'),
(84, 15, 53, '4'),
(85, 16, 45, 'ув.'),
(86, 14, 55, '3'),
(87, 9, 55, 'ув.'),
(88, 14, 54, 'б'),
(89, 14, 45, 'б'),
(90, 16, 55, '4'),
(91, 14, 63, '3'),
(92, 15, 61, '5'),
(93, 16, 63, '5'),
(94, 10, 67, '4'),
(95, 10, 62, 'н'),
(96, 14, 68, '4'),
(97, 10, 72, '5'),
(98, 14, 75, '4'),
(99, 14, 73, '5'),
(100, 14, 43, 'н'),
(101, 14, 88, '5'),
(102, 16, 85, '5'),
(103, 10, 93, '4'),
(104, 14, 94, '5'),
(105, 15, 93, '4'),
(106, 9, 92, 'н'),
(107, 9, 93, 'н'),
(109, 15, 96, 'б'),
(110, 15, 97, 'б'),
(111, 15, 98, 'б'),
(112, 10, 96, '5'),
(113, 16, 95, '4'),
(114, 16, 92, '5'),
(115, 10, 97, '3'),
(116, 10, 103, '3'),
(117, 14, 101, '4'),
(118, 9, 107, '4'),
(119, 15, 103, '5'),
(120, 14, 106, '5'),
(121, 16, 106, 'н'),
(122, 16, 102, '5'),
(123, 10, 115, '4'),
(124, 14, 117, '5'),
(126, 9, 120, '4'),
(127, 15, 115, 'н'),
(128, 15, 120, '5'),
(129, 14, 112, '4'),
(130, 15, 113, 'н'),
(131, 10, 128, '4'),
(132, 14, 128, 'н'),
(133, 15, 129, '5'),
(134, 16, 131, '4'),
(136, 10, 94, '5'),
(137, 14, 131, '5'),
(138, 14, 142, '4'),
(139, 15, 38, '5'),
(140, 14, 144, '3'),
(141, 9, 143, '5'),
(142, 16, 37, '5'),
(143, 15, 144, 'ув.'),
(144, 10, 142, 'н'),
(145, 10, 144, 'н'),
(146, 15, 142, 'н'),
(147, 16, 142, 'б'),
(148, 16, 143, 'б'),
(149, 16, 144, 'б'),
(150, 9, 96, '5'),
(151, 16, 96, '4'),
(152, 9, 95, '5'),
(154, 9, 97, '4');

-- --------------------------------------------------------

--
-- Структура таблицы `parent_student`
--

CREATE TABLE `parent_student` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parent_student`
--

INSERT INTO `parent_student` (`id`, `user_id`, `student_id`) VALUES
(6, 149, 9),
(7, 149, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_user_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `lesson_number` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`id`, `subject_user_id`, `date`, `lesson_number`) VALUES
(21, 16, '2023-03-10', 1),
(22, 16, '2023-03-20', 3),
(23, 16, '2023-04-03', 2),
(24, 16, '2023-04-11', 3),
(25, 16, '2023-04-17', 4),
(26, 16, '2023-05-10', 4),
(27, 16, '2023-05-16', 1),
(28, 16, '2023-05-18', 1),
(29, 15, '2023-03-16', 1),
(30, 15, '2023-03-20', 4),
(31, 15, '2023-04-03', 5),
(32, 15, '2023-04-18', 3),
(33, 17, '2023-04-28', 3),
(34, 17, '2023-04-30', 5),
(35, 17, '2023-05-09', 2),
(36, 17, '2023-05-16', 2),
(37, 17, '2023-06-01', 3),
(38, 17, '2023-06-02', 2),
(39, 17, '2023-05-08', 1),
(40, 17, '2023-04-28', 1),
(41, 17, '2022-11-10', 2),
(42, 17, '2022-11-18', 3),
(43, 17, '2022-12-12', 6),
(44, 17, '2023-05-12', 2),
(45, 17, '2022-09-20', 5),
(46, 17, '2022-10-18', 3),
(47, 17, '2023-05-31', 5),
(48, 17, '2022-09-06', 5),
(49, 17, '2022-09-09', 2),
(50, 17, '2022-09-09', 3),
(51, 17, '2022-09-13', 5),
(52, 17, '2022-09-16', 2),
(53, 17, '2022-09-16', 3),
(54, 17, '2022-09-23', 2),
(55, 17, '2022-09-23', 3),
(56, 17, '2022-09-27', 5),
(57, 17, '2022-09-30', 2),
(58, 17, '2022-09-30', 3),
(59, 17, '2022-10-04', 5),
(60, 17, '2022-10-07', 2),
(61, 17, '2022-10-07', 3),
(62, 17, '2022-10-11', 5),
(63, 17, '2022-10-14', 2),
(64, 17, '2022-10-14', 3),
(65, 17, '2022-10-18', 5),
(66, 17, '2022-10-21', 2),
(67, 17, '2022-10-21', 3),
(68, 17, '2022-10-25', 5),
(69, 17, '2022-10-28', 2),
(70, 17, '2022-10-28', 3),
(71, 17, '2022-11-08', 5),
(72, 17, '2022-11-11', 2),
(73, 17, '2022-11-11', 3),
(74, 17, '2022-11-15', 5),
(75, 17, '2022-11-18', 2),
(76, 17, '2022-11-18', 3),
(77, 17, '2022-11-22', 5),
(78, 17, '2022-11-25', 2),
(79, 17, '2022-11-25', 3),
(80, 17, '2022-11-29', 5),
(81, 17, '2022-12-02', 2),
(82, 17, '2022-12-02', 3),
(83, 17, '2022-12-06', 5),
(84, 17, '2022-12-09', 2),
(85, 17, '2022-12-09', 3),
(86, 17, '2022-12-13', 5),
(87, 17, '2022-12-16', 2),
(88, 17, '2022-12-16', 3),
(89, 17, '2022-12-20', 5),
(90, 17, '2022-12-23', 2),
(91, 17, '2022-12-23', 3),
(92, 17, '2023-01-17', 5),
(93, 17, '2023-01-20', 2),
(94, 17, '2023-01-20', 3),
(95, 17, '2023-01-24', 5),
(96, 17, '2023-01-27', 2),
(97, 17, '2023-01-27', 3),
(98, 17, '2023-01-31', 5),
(99, 17, '2023-02-03', 2),
(100, 17, '2023-02-03', 3),
(101, 17, '2023-02-07', 5),
(102, 17, '2023-02-10', 2),
(103, 17, '2023-02-10', 3),
(104, 17, '2023-02-14', 5),
(105, 17, '2023-02-17', 2),
(106, 17, '2023-02-17', 3),
(107, 17, '2023-02-21', 5),
(108, 17, '2023-02-24', 2),
(109, 17, '2023-02-24', 3),
(110, 17, '2023-02-28', 5),
(111, 17, '2023-03-03', 2),
(112, 17, '2023-03-03', 3),
(113, 17, '2023-03-07', 5),
(114, 17, '2023-03-10', 2),
(115, 17, '2023-03-10', 3),
(116, 17, '2023-03-14', 5),
(117, 17, '2023-03-17', 2),
(118, 17, '2023-03-17', 3),
(119, 17, '2023-03-21', 5),
(120, 17, '2023-03-24', 2),
(121, 17, '2023-03-24', 3),
(122, 17, '2023-03-28', 5),
(123, 17, '2023-03-31', 2),
(124, 17, '2023-03-31', 3),
(125, 17, '2023-04-07', 2),
(126, 17, '2023-04-07', 3),
(127, 17, '2023-04-11', 5),
(128, 17, '2023-04-14', 2),
(129, 17, '2023-04-14', 3),
(130, 17, '2023-04-18', 5),
(131, 17, '2023-04-21', 2),
(132, 17, '2023-04-21', 3),
(133, 17, '2023-04-25', 5),
(134, 17, '2023-05-02', 5),
(135, 17, '2023-05-05', 2),
(136, 17, '2023-05-12', 3),
(137, 17, '2023-05-23', 5),
(138, 17, '2023-05-19', 2),
(139, 17, '2023-05-19', 3),
(140, 17, '2023-05-26', 5),
(141, 17, '2023-06-02', 2),
(142, 17, '2023-06-02', 3),
(143, 17, '2023-06-06', 5),
(144, 17, '2023-06-09', 2),
(145, 17, '2023-06-09', 3),
(146, 17, '2023-06-13', 5),
(147, 17, '2023-06-16', 2),
(148, 17, '2023-06-16', 3),
(149, 17, '2023-06-20', 5),
(150, 17, '2023-06-23', 2),
(151, 17, '2023-06-23', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `specialty`
--

CREATE TABLE `specialty` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `specialty`
--

INSERT INTO `specialty` (`id`, `department_id`, `title`) VALUES
(8, 5, 'Программист'),
(9, 5, 'Разработка веб и мультимедийных приложений'),
(10, 6, 'Сетевой и системный администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `user_id`, `group_id`) VALUES
(5, 147, 11),
(6, 148, 11),
(7, 143, 9),
(8, 144, 9),
(9, 145, 10),
(10, 146, 10),
(11, 173, 9),
(12, 155, 9),
(13, 156, 9),
(14, 157, 10),
(15, 158, 10),
(16, 159, 10),
(17, 160, 11),
(18, 161, 11),
(19, 162, 11),
(20, 163, 23),
(21, 164, 23),
(22, 165, 23),
(23, 166, 23),
(24, 167, 23),
(25, 168, 24),
(26, 169, 24),
(27, 170, 24),
(28, 171, 24),
(29, 172, 24);

-- --------------------------------------------------------

--
-- Структура таблицы `subject_name`
--

CREATE TABLE `subject_name` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subject_name`
--

INSERT INTO `subject_name` (`id`, `title`) VALUES
(4, 'Компьюторные системы'),
(5, 'Веб-дизайн'),
(6, 'Математика'),
(7, 'Геометрия'),
(8, 'Информатика');

-- --------------------------------------------------------

--
-- Структура таблицы `subject_user`
--

CREATE TABLE `subject_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_name_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subject_user`
--

INSERT INTO `subject_user` (`id`, `subject_name_id`, `user_id`, `group_id`) VALUES
(15, 4, 141, 11),
(16, 4, 141, 9),
(17, 5, 142, 10),
(18, 5, 142, 24),
(19, 6, 142, 9),
(20, 6, 142, 10),
(21, 6, 142, 23),
(22, 6, 142, 24),
(23, 7, 142, 9),
(24, 7, 142, 10),
(25, 7, 142, 11),
(26, 8, 141, 9),
(27, 8, 141, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `gender_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `residential_address` varchar(255) NOT NULL,
  `registration_address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `gender_id`, `name`, `surname`, `patronymic`, `login`, `birthday`, `residential_address`, `registration_address`, `email`, `phone`, `password`, `auth_key`) VALUES
(1, 2, 'Администратор', 'Администратор', '', 'admin', '1998-03-10', 'адрес1', 'адрес2', 'admin@q.q', '12345678', '$2y$13$XINlLjIJ8v.fKSu1aQgvI./iDOHWMSvIaSi8Lcr4nXIDPFgzZRKs2', 'kNFROwMpygPML9HmttyfdJ8vuCEb7EdC'),
(138, 2, 'Ольга', 'Иванова', 'Дмитриевна', 'head_teacher', '1980-05-06', 'Транспортная ул., д.4., кв.40', 'Транспортная ул., д.4., кв.40', 'head_teacher@mail.ru', '8(564) 987-12-34', '$2y$13$eOJ4V.doigZIZv3QUVrNXeZLCkOEU51GgMzs9qeaSB0mOkG0lCvEe', 'Mwv819g-8ShUw0bgFGUU1JcvHxOaJX04'),
(139, 2, 'Ксения', 'Евсеева', 'Игоревна', 'head_of_department_inf', '1986-06-05', 'ул. Советская, д.3, кв. 3', 'ул. Советская, д.3, кв. 3', 'head_of_department_inf@mail.ru', '8(987) 324-12-99', '$2y$13$lykBZ5LM7KC/EdWJGxVcwuo23xJ7g5i7TaP9EEdusMdoZvcTA/FMW', 'vGVcc9ytEFFidmEbj69nTXeq2tt0xa07'),
(140, 1, 'Виктор', 'Соколов', 'Павлович', 'head_of_department_adm', '1974-01-24', 'qqq', 'rty', 'head_of_department_adm@mail.ru', '8(456) 897-98-23', '$2y$13$XLzH12WIbjdD0qmPeGNlrOZSpGRICIDZYBeCUW6jckoM4ZlqpQK4i', 'la9uwQjFRzueYIJIo7HXWbQbgFAD4ABt'),
(141, 1, 'Дмитрий', 'Иванов', 'Петрович', 'teacher1', '1970-11-12', 'адр проживания teacher1', 'адр регистрации teacher1', 'teacher1@mail.ru', '8(456) 343-12-34', '$2y$13$Dbopfsj/rpLl6XjNwFETRuvRL4xkgaMZ24faSn7Vjhaa2RY8CfLxq', 'd9t5_KqOxEnDq5udIj6EzsPzJdKMP19D'),
(142, 2, 'Елена', 'Трофимова', 'Ивановна', 'teacher2', '1984-05-11', 'адр проживания teacher2', 'адр регистрации teacher2', 'teacher2@mail.ru', '8(234) 203-90-23', '$2y$13$6rdzWuCl5IUQgRHFu.xhP.VeUtjsK/3zDFqyUTna.F8mOs2sTSJfC', 'YW74imzMnV_zDNzQXbVQL2KV7_Zf-tMg'),
(143, 1, 'Иван', 'Голубев', 'Петрович', 'student1', '2000-08-10', 'ул. Советская, д.10, кв.9', 'ул. Советская, д.10, кв.9', 'student1@mail.ru', '8(234) 239-90-34', '$2y$13$msCAfftYR8JpP.NyAb/AAuwM9b3cGYlL2/fcv.BaKjQ0IlM8vp.L6', 'np3AhPeZGLFIHWt71rXU-eDnP2wUh-sr'),
(144, 2, 'Ольга', 'Березина', '', 'student2', '2000-11-11', 'адр проживания student2', 'адр регистрации student2', 'student2@mail.ru', '8(679) 234-02-34', '$2y$13$DNrR32ASQnnWONWN6NX7GONYHlIljZMT/4znzQWiyGWjHURgWC0Na', 'Pu87mWF06er8qs6SEGbL57ZleB4YSrjI'),
(145, 2, 'Алёна', 'Алфимова', 'Петровна', 'student3', '2000-05-13', 'адр проживания student3', 'адр регистрации student3', 'student3@mail.ru', '8(345) 234-23-45', '$2y$13$vN7cxvwyqApdT9YrmFMk9ePjAir9ikCMp1nuaQKX7/0kFVzezKZpu', 'ukTEE7w4J3XDy2lwpG_DSuE_bBZHJTHU'),
(146, 1, 'Пётр', 'Малышев', 'Иванович', 'student4', '2000-12-18', 'адр проживания student4', 'адр регистрации student4', 'student4@mail.ru', '8(234) 345-34-12', '$2y$13$nacqswCAo8zTpwz07Kq5O.jNl/3h27MPM8jQD4A3OXU4cb2GeL8cu', '8yiZraQtq3E9Lggq2sdaG6Cf-QnF3IOf'),
(147, 1, 'Алексей', 'Алфимов', 'Петрович', 'student5', '2000-10-08', 'ул. Советская, д.10, кв.9', 'ул. Советская, д.10, кв.9', 'student5@mail.ru', '8(345) 234-23-23', '$2y$13$NKSrCjFLUXp.gDurvnXrcOm1yfh1hVnVxQLnU4I.OHTqPDl.fonFq', '5Acb8zl1BHYtvIPQhrtbhp5y98yYZAvU'),
(148, 2, 'Юлия', 'Орлова', 'Игоревна', 'student6', '2000-04-23', 'адр проживания student6', 'адр проживания student6', 'student6@mail.ru', '8(434) 234-23-54', '$2y$13$Ze15JXf1lw2KGqJvx/Q53OYKpLyNDcSldkk0R0rikTjawGx0NUCL.', '8VBxzrjOke9szKIToMjdKjOu5dKX-TXE'),
(149, 2, 'Ольга', 'Алфимова', 'Игоревна', 'parent1', '1980-05-30', 'ул. Советская, д.10, кв.9', 'ул. Советская, д.10, кв.9', 'parent1@mail.ru', '8(234) 345-43-12', '$2y$13$YmuafelI.c5a9QPuitWZ2.exjJ8WOGN6p1u3ScynseUmhbhLAVFJe', 'bR8omTICVOPH5GY8ozDaZUx1kOYyyoho'),
(155, 2, 'Эльвира', 'Горелова', 'Николаевна', 'student8', '2000-02-09', 'адр проживания student8', 'адр регистрации student8', 'student8@mail.ru', '8 (793) 807-57-43', '$2y$13$/PAc3qECJNyWqL2AbHJWM.yvKEMBk1iuVOU6Qg2mPXQrpIXynYi7i', 'u3kHmNou0bz88QTm1ATPK4E6TWZHgn3s'),
(156, 1, 'Максим', 'Озёров', 'Петрович', 'student9', '2000-08-23', 'адр проживания student9', 'адр регистрации student9', 'student9@mail.ru', '8(374) 890-23-12', '$2y$13$CmvdXsSSfP.pdJOt2xWqwOQjZjI1cDixhnPdiwzLniFbpU7fUYy12', '5RfQpYV542Nbn2AgM82nu6MrGtThfY_D'),
(157, 2, 'Ольга', 'Рябинина', 'Михайловна', 'student10', '2000-07-23', 'адр проживания student10', 'адр регистрации student10', 'student10@mail.ru', '8(987) 689-89-45', '$2y$13$IPySQR1CxPgBpIe0kTNov.cjh2fNHgj514mfdGp2jwk54.hrDjau6', 'Z37g0KItU_work9biZMLVOCfYZVsqiUP'),
(158, 1, 'Михаил', 'Сахаров', 'Иванович', 'student11', '2000-08-07', 'адр проживания student11', 'адр регистрации student11', 'student11@mail.ru', '8(987) 689-45-34', '$2y$13$i/BXZ2hSfdjaMuk2f1slT.RQ5xOACdlCFkKlGOJEhjpCchQLzmJx6', 'E7S8rTPGdIwV-1PFhq1-ezCSHMVtJhDD'),
(159, 1, 'Денис', 'Шахов', 'Иванович', 'student12', '2000-06-05', 'адр проживания student12', 'адр регистрации student12', 'student12@mail.ru', '8(786) 890-45-34', '$2y$13$cJvBJf.hTPz21tlaDaGQreuWGzMUVzMPem3GSwL4ORmbnoft2o1m6', 'zS6zHflO4idHiVRhBGlYYwDMwK_P-Gh3'),
(160, 1, 'Пётр', 'Акимов', '', 'student13', '2000-07-08', 'адр проживания student13', 'адр регистрации student13', 'student13@mail.ru', '8(567) 348-34-12', '$2y$13$NOYrGA3HwvV6H/GFuDdfReywT9psiP.ltG8tuGbZcEFID195JPpPy', '2tQGjUFaNSc65ZrJ0Sp9BOkXjOhZqGGn'),
(161, 1, 'Григорий', 'Сергеев', 'Иванович', 'student14', '2000-03-23', 'адр проживания student14', 'адр регистрации student14', 'student14@mail.ru', '8(567) 876-34-12', '$2y$13$7/Urq.lodszs7Bdlvr7X4OvkAxMb/9sK2n4v9rslQvneQ2AQlNThi', 'TwG8NZ6Bb8HapIhLEzEUDzU_MHXKrb3Q'),
(162, 2, 'Юлия', 'Ткаченко', 'Дмитриевна', 'student15', '2000-09-23', 'адр проживания student15', 'адр регистрации student15', 'student15@mail.ru', '8(578) 576-34-23', '$2y$13$oNMle9CBVNJVQwgmYlKSQuh2hu8lOnJrfDO1ZB.Q0Jb1jZcSdNmYO', 'Ev5toiHYf45TG1LPb5o6yod1WqEl_vZD'),
(163, 2, 'Виктория', 'Лемехова', 'Олеговна', 'student16', '2000-03-23', 'адр проживания student16', 'адр регистрации student16', 'student16@mail.ru', '8(687) 567-45-34', '$2y$13$PWCBaGLinExtNkOKj66AuurGJK4u1QIvDNhQlNNUREQEW0SOIa8mW', 'HrOB-19WV5jGKZnD6pUOwDTVlVEDU015'),
(164, 2, 'Светлана', 'Голиновская', '', 'student17', '2000-03-12', 'адр проживания student17', 'адр регистрации student17', 'student17@mail.ru', '8(678) 567-23-67', '$2y$13$bzR.Sjt0JrxF5wpCzrH4O.RUIqkCBqcswo6BSvsB2/dwqtdvR76me', 'VgDHEeyGGZeFCHA9Aebvk4tr5jdR7mm-'),
(165, 1, 'Павел', 'Лоскутов', 'Петрович', 'student18', '2000-04-23', 'адр проживания student18', 'адр регистрации student18', 'student18@mail.ru', '8(678) 768-56-98', '$2y$13$gRTLHGGDDg9wLL1nCUg62uatVC66gV3TZz6nyJvMpuXoSJgowquoK', '6nSvVZ0jNqT5NJ3VUVl-JYOHKivRzvCB'),
(166, 1, 'Иван', 'Сергеев', '', 'student19', '2000-03-03', 'адр проживания student19', 'адр регистрации student19', 'student19@mail.ru', '8(989) 679-45-45', '$2y$13$UZj1UBWf5lb2iw4baP9RLOPYeIqIKU9v7hfaHffrTPnH.Pk3GhYK.', 'AQ6ag_aoYagZtQJmeyUZvHxUjMUWccxF'),
(167, 1, 'Анатолий', 'Степашин', 'Петрович', 'student20', '2000-08-09', 'адр проживания student20', 'адр регистрации student20', 'student20@mail.ru', '8(567) 348-45-98', '$2y$13$j8S39h19RUmXnDRSL5oomuKZEBTN7k/K9QWSet0p9GvUta5ogK76u', 'PLWm7Mx9CYun2sy5ljRev3Xnem0CzFrw'),
(168, 1, 'Пётр', 'Денисов', '', 'student21', '2000-05-09', 'адр проживания student21', 'адр регистрации student21', 'student21@mail.ru', '8(909) 687-68-64', '$2y$13$chuAdcxi5QJ2DCzM73a48OB9YqehonNfdmwyFLnz/ESqHGMIL3oF.', 'q3Gw9W2rUoLV2kzZmuEFzi4WgM5SzazY'),
(169, 2, 'Ольга', 'Королёва', 'Викторовна', 'student22', '2000-08-23', 'адр проживания student22', 'адр регистрации student22', 'student22@mail.ru', '8(689) 678-54-65', '$2y$13$gehns1F9x2bMXza7ILmwX.74xy97WdYvkBHOz756FyhXu6kBBzxTq', 'DS4FbztqkyGF4y1Ijj8T5L4JSIDrO_oo'),
(170, 2, 'Юлия', 'Светова', 'Михайловна', 'student23', '2000-09-23', 'адр проживания student23', 'адр регистрации student23', 'student23@mail.ru', '8(676) 787-87-26', '$2y$13$UOWeJoVoMt.I2q4bbqSoQOcS.S2UnCeCkuXZxK6WjxWLKgv5EzEti', 'EJjV_AVgdnmtpbX_SdrSiBOuNZJfquHd'),
(171, 1, 'Павел', 'Цветков', 'Дмитриевич', 'student24', '2000-05-04', 'адр проживания student24', 'адр регистрации student24', 'student24@mail.ru', '8(687) 456-28-39', '$2y$13$BagKb2GhWYjMWbkWmH.S4OGdw/pLAEueSXz2tb2ftP.L2zLnt9h1u', 'pbYYBhg-mRD8g9kCORzgj5N1JrbamQlT'),
(172, 1, 'Олег', 'Михайлов', 'Григорьевич', 'student25', '2000-04-05', 'адр проживания student25', 'адр регистрации student25', 'student25@mail.ru', '8(688) 682-32-92', '$2y$13$lk.Yp.YfWa.5piiixvo7LuRGdz1xYNjedu1S9I7thH2nDwOK0Sjbu', 'B3v7fDy1IjtOyIdZvaLIAzYlCAe-3xn3'),
(173, 2, 'Алёна', 'Андреева', 'Дмитриевна', 'student7', '2000-09-23', 'адр проживания student7', 'адр регистрации student7', 'student7@mail.ru', '8(483) 302-43-23', '$2y$13$8z9FqicZjXbPi1L8ZOR5BeLH5qq46jPovu554VprKKNLhoJBJl6Fu', 'dXyxw5jB4Bd3I302DIQxkiRMoGsUqkHd');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD UNIQUE KEY `created_at` (`created_at`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_name` (`item_name`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialty_id` (`specialty_id`);

--
-- Индексы таблицы `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`lesson_id`);

--
-- Индексы таблицы `parent_student`
--
ALTER TABLE `parent_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_name_id` (`subject_user_id`);

--
-- Индексы таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `subject_name`
--
ALTER TABLE `subject_name`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subject_user`
--
ALTER TABLE `subject_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_ibfk_1` (`user_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `subject_user_ibfk_2` (`subject_name_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `auth_key` (`auth_key`),
  ADD KEY `gender_id` (`gender_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT для таблицы `parent_student`
--
ALTER TABLE `parent_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT для таблицы `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `subject_name`
--
ALTER TABLE `subject_name`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `subject_user`
--
ALTER TABLE `subject_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `group`
--
ALTER TABLE `group`
  ADD CONSTRAINT `group_ibfk_1` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`lesson_id`) REFERENCES `schedule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `parent_student`
--
ALTER TABLE `parent_student`
  ADD CONSTRAINT `parent_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parent_student_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`subject_user_id`) REFERENCES `subject_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD CONSTRAINT `specialty_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subject_user`
--
ALTER TABLE `subject_user`
  ADD CONSTRAINT `subject_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_user_ibfk_2` FOREIGN KEY (`subject_name_id`) REFERENCES `subject_name` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subject_user_ibfk_4` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
