-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 25 Ara 2025, 07:41:15
-- Sunucu sürümü: 8.0.44
-- PHP Sürümü: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `enem_co`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haberler`
--

DROP TABLE IF EXISTS `haberler`;
CREATE TABLE IF NOT EXISTS `haberler` (
  `id` int NOT NULL AUTO_INCREMENT,
  `baslik` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ozet` text COLLATE utf8mb4_general_ci,
  `resim` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `haberler`
--

INSERT INTO `haberler` (`id`, `baslik`, `ozet`, `resim`) VALUES
(2, 'Dünya Gündemine Oturdu', 'Yeni insansız hava aracı akıllara durgunluk getirdi...', 'foto4.jpg'),
(4, 'Yeni Teknolojide Büyük Gelişme', 'Yapay bulut sağanak yağışlarına başladı...', 'foto4.jpg'),
(5, 'İşte BU!!!!', 'Detaylar için', 'foto4.jpg'),
(6, 'vay BE!!!!', 'Bir bak istersen...', 'foto3.jpg'),
(7, 'İşler Değiştiiii', 'Tabi Ki de haber burda', 'foto3.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim_mesajlari`
--

DROP TABLE IF EXISTS `iletisim_mesajlari`;
CREATE TABLE IF NOT EXISTS `iletisim_mesajlari` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isim` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telefon` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `konu` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mesaj` text COLLATE utf8mb4_general_ci,
  `tarih` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `iletisim_mesajlari`
--

INSERT INTO `iletisim_mesajlari` (`id`, `isim`, `telefon`, `email`, `konu`, `mesaj`, `tarih`) VALUES
(2, 'a', '55', 'enes@gmail.com', 'asdas', 'sdasda', '2025-12-18 19:40:45'),
(3, 'rek', '545465', 'enes@gmail.com', 'jxjxx', 'xemmex', '2025-12-24 18:03:49');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

DROP TABLE IF EXISTS `kullanicilar`;
CREATE TABLE IF NOT EXISTS `kullanicilar` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isim` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rol` enum('admin','editor','user') COLLATE utf8mb4_general_ci DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `isim`, `email`, `sifre`, `rol`) VALUES
(1, 'Enes Kozan', 'enes@gmail.com', '$2y$10$FdC38bBv5r5mVL2wNUJu6.M5Dvv7qqWbTy27a7C9FgE6PgPsZnPmi', 'admin'),
(2, 'Başar Mete Yahşi', 'mete@gmail.com', '$2y$10$YM132LeA9zwJT.UYAsTVeeG74LU6aH4iPKwBuAUYPsyLujGiaOfHS', 'user'),
(4, 'REK', 'rek@gmail.com', '$2y$10$UwDDMpEpVa86Pbrl1jLGmO0w9Wlrry4U8W.kxmYqNSy4Oq4mR6X1S', 'editor');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
