<?php
$host = "localhost"; // Genelde localhost kalır
$vt_adi = "enem_co"; // phpMyAdmin'de verdiğiniz isim
$kullanici = "root"; // XAMPP için varsayılan root'tur
$sifre = "mysql378"; // XAMPP için genelde boştur

try {
    $db = new PDO("mysql:host=$host;dbname=$vt_adi;charset=utf8", $kullanici, $sifre);
    // Bağlantı başarılıysa bir şey yazdırmasına gerek yok
} catch (PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
    die();
}
?>