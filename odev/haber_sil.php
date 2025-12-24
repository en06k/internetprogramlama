<?php
session_start();
include 'baglan.php';

// Güvenlik: Sadece yetkililer silebilir
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'editor')) {
    header("Location: index.php"); exit();
}

// URL'den gelen id parametresini alıyoruz
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Önce haberin resim adını çekip klasörden de silebiliriz (isteğe bağlı)
    // Ama şimdilik sadece veritabanından silelim:
    $sorgu = $db->prepare("DELETE FROM haberler WHERE id = ?");
    $sil = $sorgu->execute([$id]);

    if ($sil) {
        header("Location: haber_yonetimi.php?durum=silindi");
    } else {
        header("Location: haber_yonetimi.php?durum=hata");
    }
} else {
    header("Location: haber_yonetimi.php");
}
?>