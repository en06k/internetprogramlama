<?php 
include 'baglan.php';

if ($_POST) {
    $isim = htmlspecialchars($_POST['isim']);
    $email = htmlspecialchars($_POST['email']);
    $sifre = password_hash($_POST['sifre'], PASSWORD_DEFAULT);
    $rol = "user"; 

    try {
        $sorgu = $db->prepare("INSERT INTO kullanicilar SET isim=?, email=?, sifre=?, rol=?");
        $ekle = $sorgu->execute([$isim, $email, $sifre, $rol]);

        if ($ekle) {
            header("Location: giris.php?durum=basarili");
            exit();
        }
    } catch (PDOException $e) {
        // Eğer hata varsa ekrana yazdıracaktır, böylece sorunu anlarız:
        $hata_mesaji = "Kayıt hatası: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol | enem.co</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #2c3e50, #2ecc71); min-height: 100vh; display: flex; align-items: center; font-family: sans-serif; }
        .register-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); background: #fff; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card register-card p-4">
                    <h2 class="text-center fw-bold mb-4">Kayıt Ol</h2>
                    
                    <?php if(isset($hata_mesaji)): ?>
                        <div class="alert alert-danger small"><?php echo $hata_mesaji; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Ad Soyad</label>
                            <input type="text" name="isim" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-posta</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Şifre</label>
                            <input type="password" name="sifre" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold">Üyeliği Tamamla</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="giris.php" class="text-decoration-none small text-muted">Zaten hesabım var</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>