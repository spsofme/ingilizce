-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 May 2022, 14:15:48
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ingilizce`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cumleler`
--

CREATE TABLE `cumleler` (
  `ID` int(11) NOT NULL,
  `turkce` varchar(200) COLLATE utf8_turkish_ci NOT NULL,
  `ingilizce` varchar(200) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kaliplar`
--

CREATE TABLE `kaliplar` (
  `ID` int(11) NOT NULL,
  `turkce` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `ingilizce` varchar(100) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kelimeler`
--

CREATE TABLE `kelimeler` (
  `ID` int(11) NOT NULL,
  `anlam` varchar(150) COLLATE utf8_turkish_ci NOT NULL,
  `kelime` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hal-2` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `hal-3` varchar(50) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `notlar`
--

CREATE TABLE `notlar` (
  `ID` int(11) NOT NULL,
  `baslik` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` varchar(200) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cumleler`
--
ALTER TABLE `cumleler`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `kaliplar`
--
ALTER TABLE `kaliplar`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `kelimeler`
--
ALTER TABLE `kelimeler`
  ADD PRIMARY KEY (`ID`);

--
-- Tablo için indeksler `notlar`
--
ALTER TABLE `notlar`
  ADD PRIMARY KEY (`ID`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cumleler`
--
ALTER TABLE `cumleler`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kaliplar`
--
ALTER TABLE `kaliplar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kelimeler`
--
ALTER TABLE `kelimeler`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `notlar`
--
ALTER TABLE `notlar`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
