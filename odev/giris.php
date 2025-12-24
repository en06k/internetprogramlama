<?php 
session_start();
include 'baglan.php';

if ($_POST) {
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];

    $sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE email = ?");
    $sorgu->execute([$email]);
    $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

    if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
        $_SESSION['kullanici_id'] = $kullanici['id'];
        $_SESSION['rol'] = $kullanici['rol'];
        $_SESSION['isim'] = $kullanici['isim'];
        header("Location: index.php");
    } else {
        $hata = "E-posta veya şifre hatalı!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap | enem.co</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #2c3e50, #3498db); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); }
        .btn-login { background-color: #3498db; border: none; padding: 12px; font-weight: bold; }
        .btn-login:hover { background-color: #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">Giriş Yap</h2>
                        <p class="text-muted">enem.co Haber Dünyasına Hoş Geldiniz.</p>
                    </div>
                    
                    <?php if(isset($hata)): ?>
                        <div class="alert alert-danger"><?php echo $hata; ?></div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">E-posta Adresi</label>
                            <input type="email" name="email" class="form-control" placeholder="örnek@mail.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Şifre</label>
                            <input type="password" name="sifre" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-login">Giriş Yap</button>
                        </div>
                        <div class="text-center">
                            <span class="text-muted small">Hesabınız yok mu?</span> 
                            <a href="kayit.php" class="text-decoration-none small fw-bold">Kayıt Ol</a>
                        </div>
                    </form>
                </div>
                <div class="text-center mt-3 text-white-50">
                    <a href="index.php" class="text-white text-decoration-none small"><i class="fas fa-arrow-left"></i> Anasayfaya Dön</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>