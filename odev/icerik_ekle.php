<?php
session_start();
include 'baglan.php';

// Yetki Kontrolü (Admin veya Editor değilse giremez)
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'editor')) {
    header("Location: index.php"); exit();
}

if ($_POST) {
    $baslik = htmlspecialchars($_POST['baslik']);
    $ozet = htmlspecialchars($_POST['ozet']);
    
    // Dosya Yükleme Hazırlığı
    $resim_adi = $_FILES['resim']['name'];
    $gecici_yol = $_FILES['resim']['tmp_name'];
    $hedef = "img/" . $resim_adi;

    if (move_uploaded_file($gecici_yol, $hedef)) {
        $sorgu = $db->prepare("INSERT INTO haberler SET baslik=?, ozet=?, resim=?");
        $sorgu->execute([$baslik, $ozet, $resim_adi]);
        echo "<script>alert('Haber Başarıyla Eklendi!'); window.location.href='panel.php';</script>";
    } else {
        echo "<script>alert('Resim yüklenirken hata oluştu!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Yeni Haber Ekle</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Yeni İçerik Paylaş</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label font-weight-bold">Haber Başlığı</label>
                                <input type="text" name="baslik" class="form-control" required placeholder="Başlık giriniz...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kısa Özet</label>
                                <textarea name="ozet" class="form-control" rows="4" required placeholder="Haber detaylarını yazınız..."></textarea>
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Haber Görseli Seç</label>
                                <input type="file" name="resim" class="form-control" accept="image/*" required>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success btn-lg">Haberi Yayınla</button>
                                <a href="panel.php" class="btn btn-light">Panele Geri Dön</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>