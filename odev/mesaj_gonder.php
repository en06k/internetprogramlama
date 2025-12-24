<?php
// Veritabanı bağlantısını dahil ediyoruz
include 'baglan.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen verileri güvenli şekilde alıyoruz
    $isim  = htmlspecialchars($_POST['isim']);
    $tel   = htmlspecialchars($_POST['tel']);
    $mail  = htmlspecialchars($_POST['mail']);
    $konu  = htmlspecialchars($_POST['konu']);
    $mesaj = htmlspecialchars($_POST['mesaj']);

    try {
        // Verileri tabloya eklemek için hazırlıyoruz
        $sorgu = $db->prepare("INSERT INTO iletisim_mesajlari (isim, telefon, email, konu, mesaj) VALUES (?, ?, ?, ?, ?)");
        $sonuc = $sorgu->execute([$isim, $tel, $mail, $konu, $mesaj]);

        if ($sonuc) {
            // Başarılı ise kullanıcıya uyarı ver ve anasayfaya dön
            echo "<script>alert('Mesajınız başarıyla iletildi. Teşekkür ederiz!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Mesaj gönderilirken bir hata oluştu.'); window.history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "Hata oluştu: " . $e->getMessage();
    }
} else {
    // Sayfaya doğrudan erişimi engelle
    header("Location: index.php");
    exit();
}
?>