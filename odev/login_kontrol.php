<?php include 'baglan.php'; ?>
<?php
session_start();
// Veritabanı bağlantısı buraya gelecek

if ($_POST) {
    $email = $_POST['mail'];
    $sifre = $_POST['sifre'];

    // Kullanıcıyı sorgula (Gerçek projede şifre password_verify ile kontrol edilmeli)
    // Örnek giriş başarılı varsayalım:
    $_SESSION['kullanici_id'] = 1;
    $_SESSION['rol'] = 'admin'; // Veritabanından gelen rol
    header("Location: panel.php");
}
?>