-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 04, 2024 at 08:48 AM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `euro`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `druzyny`
--

CREATE TABLE `druzyny` (
  `id` int(11) NOT NULL,
  `kraj` varchar(45) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `druzyny`
--

INSERT INTO `druzyny` (`id`, `kraj`) VALUES
(1, 'Niemcy'),
(2, 'Szkocja'),
(3, 'Węgry'),
(4, 'Szwajcaria'),
(5, 'Hiszpania'),
(6, 'Chorwacja'),
(7, 'Włochy'),
(8, 'Albania'),
(9, 'Słowenia'),
(10, 'Dania'),
(11, 'Serbia'),
(12, 'Anglia'),
(13, 'Polska'),
(14, 'Holandia'),
(15, 'Austria'),
(16, 'Francja'),
(17, 'Belgia'),
(18, 'Słowacja'),
(19, 'Rumunia'),
(20, 'Ukraina'),
(21, 'Turcja'),
(22, 'Gruzja'),
(23, 'Portugalia'),
(24, 'Czechy');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mecze`
--

CREATE TABLE `mecze` (
  `id_meczu` int(11) NOT NULL,
  `id_druzyna_1` int(11) NOT NULL,
  `id_druzyna_2` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `id_osoby` int(11) NOT NULL,
  `login` varchar(75) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(128) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `typ` int(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typy`
--

CREATE TABLE `typy` (
  `id_meczu` int(11) NOT NULL,
  `id_osoby` int(11) NOT NULL,
  `typ` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `typy_osoby`
--

CREATE TABLE `typy_osoby` (
  `id` int(11) NOT NULL,
  `typ` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `typy_osoby`
--

INSERT INTO `typy_osoby` (`id`, `typ`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyniki`
--

CREATE TABLE `wyniki` (
  `id_meczu` int(11) NOT NULL,
  `wynik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zaglosowane`
--

CREATE TABLE `zaglosowane` (
  `id_osoby` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `druzyny`
--
ALTER TABLE `druzyny`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `mecze`
--
ALTER TABLE `mecze`
  ADD PRIMARY KEY (`id_meczu`);

--
-- Indeksy dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`id_osoby`);

--
-- Indeksy dla tabeli `typy_osoby`
--
ALTER TABLE `typy_osoby`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `wyniki`
--
ALTER TABLE `wyniki`
  ADD PRIMARY KEY (`id_meczu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `druzyny`
--
ALTER TABLE `druzyny`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mecze`
--
ALTER TABLE `mecze`
  MODIFY `id_meczu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `osoby`
--
ALTER TABLE `osoby`
  MODIFY `id_osoby` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `typy_osoby`
--
ALTER TABLE `typy_osoby`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
