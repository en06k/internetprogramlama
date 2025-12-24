<?php
session_start();
include 'baglan.php';

//Giriş yapmayan veya 'user' olanları kov
if (!isset($_SESSION['rol']) || $_SESSION['rol'] == 'user') {
    header("Location: index.php?hata=yetkisiz");
    exit();
}

$rol = $_SESSION['rol'];
$isim = $_SESSION['isim'];

// İstatistikleri Veritabanından Çekme
try {
    $haber_sayisi = $db->query("SELECT count(*) FROM haberler")->fetchColumn();
    $mesaj_sayisi = $db->query("SELECT count(*) FROM iletisim_mesajlari")->fetchColumn();
    // Eğer kullanicilar tablon varsa toplam kullanıcıyı da çekelim
    $user_sayisi = $db->query("SELECT count(*) FROM kullanicilar")->fetchColumn();
} catch (PDOException $e) {
    // Tablo yoksa hata vermemesi için 0 
    $haber_sayisi = 0; $mesaj_sayisi = 0; $user_sayisi = 0;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetim Paneli | enem.co</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; padding-top: 20px; }
        .sidebar a { color: #bdc3c7; text-decoration: none; padding: 12px 20px; display: block; transition: 0.3s; border-left: 4px solid transparent; }
        .sidebar a:hover, .sidebar a.active { background: #34495e; color: white; border-left: 4px solid #3498db; }
        .stat-card { border: none; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .content-area { padding: 30px; }
        .quick-btn { transition: 0.3s; text-decoration: none; }
        .quick-btn:hover { transform: translateY(-3px); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar">
            <div class="text-center mb-4">
                <i class="fas fa-user-shield fa-4x text-info mb-2"></i>
                <h5 class="mb-0"><?php echo htmlspecialchars($isim); ?></h5>
                <span class="badge bg-info text-dark mt-2"><?php echo strtoupper($rol); ?></span>
            </div>
            <nav class="mt-4">
                <a href="panel.php" class="active"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
                <a href="icerik_ekle.php"><i class="fas fa-plus-circle me-2"></i> Yeni Haber Ekle</a>
                <a href="haber_yonetimi.php"><i class="fas fa-tasks me-2"></i> Haberleri Yönet</a>
                <?php if ($rol == 'admin'): ?>
                    <a href="gelen_mesajlar.php"><i class="fas fa-envelope me-2"></i> Gelen Mesajlar</a>
                <?php endif; ?>
                <hr class="text-secondary">
                <a href="index.php" target="_blank"><i class="fas fa-globe me-2"></i> Siteyi Görüntüle</a>
                <a href="cikis.php" class="text-danger mt-5"><i class="fas fa-power-off me-2"></i> Güvenli Çıkış</a>
            </nav>
        </div>

        <div class="col-md-9 col-lg-10 content-area">
            <h2 class="mb-4 text-dark border-bottom pb-3">Hoş Geldiniz, Yönetim Paneli Hazır</h2>

            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card stat-card bg-primary text-white mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1">Toplam Haber</p>
                                <h2 class="mb-0"><?php echo $haber_sayisi; ?></h2>
                            </div>
                            <i class="fas fa-newspaper fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card bg-success text-white mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1">Gelen Mesajlar</p>
                                <h2 class="mb-0"><?php echo $mesaj_sayisi; ?></h2>
                            </div>
                            <i class="fas fa-comments fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card bg-warning text-dark mb-3">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1">Kayıtlı Kullanıcı</p>
                                <h2 class="mb-0"><?php echo $user_sayisi; ?></h2>
                            </div>
                            <i class="fas fa-users fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-3 mt-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-secondary fw-bold"><i class="fas fa-bolt me-2 text-warning"></i> Hızlı İşlemler</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-wrap gap-3">
                        <a href="icerik_ekle.php" class="quick-btn btn btn-outline-primary px-4 py-3 rounded-3 text-center" style="width: 160px;">
                            <i class="fas fa-file-export fa-2x mb-2 d-block"></i> Haber Yayınla
                        </a>
                        <a href="haber_yonetimi.php" class="quick-btn btn btn-outline-dark px-4 py-3 rounded-3 text-center" style="width: 160px;">
                            <i class="fas fa-layer-group fa-2x mb-2 d-block"></i> İçerik Yönetimi
                        </a>
                        <?php if ($rol == 'admin'): ?>
                        <a href="gelen_mesajlar.php" class="quick-btn btn btn-outline-success px-4 py-3 rounded-3 text-center" style="width: 160px;">
                            <i class="fas fa-envelope-open-text fa-2x mb-2 d-block"></i> Mesajları Oku
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>