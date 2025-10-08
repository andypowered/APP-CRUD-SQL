-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 08 2025 г., 13:09
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `colegiu`
--

-- --------------------------------------------------------

--
-- Структура таблицы `elevi`
--

CREATE TABLE `elevi` (
  `id` int(11) NOT NULL,
  `nume` varchar(100) NOT NULL,
  `prenume` varchar(100) NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `data_nastere` date NOT NULL,
  `adresa` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nota_medie_bac` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `elevi`
--

INSERT INTO `elevi` (`id`, `nume`, `prenume`, `sex`, `data_nastere`, `adresa`, `email`, `nota_medie_bac`) VALUES
(1, 'Popescu', 'фыв', 'F', '2000-03-15', 'Strada Florilor nr. 10', 'maria.popescu@email.com', 9.25),
(2, 'Ionescu', 'Andrei', 'M', '1999-07-22', 'Bulevardul Libertății nr. 45', 'andrei.ionescu@email.com', 8.75),
(3, 'Dumitru', 'Elena', 'F', '2000-11-08', 'Aleea Castanilor nr. 7', 'elena.dumitru@email.com', 9.50),
(4, 'Radu', 'Cristian', 'M', '1999-12-30', 'Strada Mihai Eminescu nr. 23', 'cristian.radu@email.com', 8.20),
(5, 'Stanciu', 'Ioana', 'F', '2000-05-18', 'Strada Viitorului nr. 15', 'ioana.stanciu@email.com', 9.80),
(6, 'Mihai', 'Alexandru', 'M', '1999-09-14', 'Bulevardul Unirii nr. 67', 'alexandru.mihai@email.com', 7.95),
(7, 'Florescu', 'Ana', 'F', '2000-01-25', 'Strada Primăverii nr. 12', 'ana.florescu@email.com', 8.90),
(8, 'Constantin', 'Mihai', 'M', '1999-08-03', 'Aleea Trandafirilor nr. 9', 'mihai.constantin@email.com', 9.10),
(9, 'Gheorghe', 'Andreea', 'F', '2000-06-11', 'Strada Speranței nr. 34', 'andreea.gheorghe@email.com', 8.65);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `elevi`
--
ALTER TABLE `elevi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `elevi`
--
ALTER TABLE `elevi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
