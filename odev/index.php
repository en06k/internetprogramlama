<?php 
// Oturum yönetimini başlatıyoruz
session_start(); 
// Veritabanı bağlantısını dahil ediyoruz
include 'baglan.php'; 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa | enem.co</title>

    <link rel="stylesheet" href="css/style.css">

    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    
    <header>
        <div class="container header-flex">
            
            <div class="header-right d-none d-md-block">
                <span class="text-muted small"><?php echo date('d.m.Y'); ?> | Güncel Haber Merkezi</span>
            </div>
        </div>
    </header>
 
    <section id="Menu">
        <nav>
            <a href="index.php"><i class="fas fa-home"></i> Anasayfa</a>
            <a href="#egitimler"><i class="fas fa-newspaper"></i> Haberler</a>
            <a href="#Hakkımızda"><i class="fas fa-info-circle"></i> Hakkımızda</a>
            <a href="#iletisim"><i class="fas fa-envelope"></i> İletişim</a>

            <?php if (isset($_SESSION['rol'])): ?>
                <?php if ($_SESSION['rol'] == 'admin' || $_SESSION['rol'] == 'editor'): ?>
                    <a href="panel.php" style="color: #f1c40f;"><i class="fas fa-user-shield"></i> Yönetim Paneli</a>
                <?php endif; ?>

                <a href="cikis.php" style="color: #e74c3c;"><i class="fas fa-sign-out-alt"></i> Çıkış Yap (<?php echo htmlspecialchars($_SESSION['isim']); ?>)</a>
            
            <?php else: ?>
                <a href="giris.php" style="color: #3498db;"><i class="fas fa-user"></i> Giriş Yap</a>
                <a href="kayit.php" style="color: #2ecc71;"><i class="fas fa-user-plus"></i> Kayıt Ol</a>
            <?php endif; ?>
        </nav>
    </section>

    <section id="Anasayfa">
        <div id="black"></div>
        <div id="İcerik">
            <h2>enem.co</h2>
            <hr width="300">
            <p>Geleceğin Teknolojileri ile Tanışın</p>
        </div>
    </section>

    <section id="egitimler">
        <div class="container">
            <h3 class="section-title">Son Haberler</h3>
            <div class="card-wrapper">
                <?php
                // Veritabanından haberleri çekiyoruz
                $sorgu = $db->query("SELECT * FROM haberler ORDER BY id DESC");
                $haberler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

                if($haberler):
                    foreach($haberler as $haber):
                ?>
                    <div class="card">
                        <img src="img/<?php echo $haber['resim']; ?>" alt="Haber Görseli" class="img-fluid">
                        <div class="card-body">
                            <h5><?php echo htmlspecialchars($haber['baslik']); ?></h5>
                            <p><?php echo htmlspecialchars($haber['ozet']); ?></p>
                        </div>
                    </div>
                <?php 
                    endforeach; 
                else:
                    echo "<p style='text-align:center; width:100%;'>Henüz bir haber eklenmemiş.</p>";
                endif; 
                ?>
            </div>
        </div>
    </section>

    <section id="Hakkımızda">
        <div class="container"> 
            <h3 class="section-title">Hakkımızda</h3>
            <div style="text-align: center; max-width: 800px; margin: 0 auto;">
                <h4>Biz Kimiz?</h4>
                <p>enem.co, modern web çözümleri ve dinamik içerik yönetimi konusunda uzmanlaşmış bir platformdur. Kullanıcı yetkilendirme ve dinamik veritabanı altyapısı ile projelerinize değer katıyoruz.</p>
            </div>
        </div>
    </section>

<section id="iletisim">
    <div class="container">
        <h3 class="section-title">İletişim</h3>
        <div id="iletisimopak">
            <form id="formgroup" action="mesaj_gonder.php" method="POST"> 
                <div id="infoform">
                    <input type="text" name="isim" placeholder="Ad Soyad" required class="form-control">
                    <input type="tel" name="tel" placeholder="Telefon Numarası" required class="form-control">
                    <input type="email" name="mail" placeholder="Email Adresiniz" required class="form-control">
                    <input type="text" name="konu" placeholder="Konu Başlığı" required class="form-control">
                </div>
                <textarea name="mesaj" id="mesaj" cols="30" placeholder="Mesajınızı buraya yazınız..." rows="6" required class="form-control"></textarea>
                
                <input type="submit" value="Mesajı Gönder">
            </form>
            
            <div id="adres">
                <h4>Adres Bilgileri</h4>
                <p><i class="fas fa-map-marker-alt"></i> Merkez Mah. Kutlu Bey Sk. No:26</p>
                <p><i class="fas fa-phone"></i> 0378 999 99 99</p>
                <p><i class="fas fa-envelope"></i> info@enem.co</p>
            </div>
        </div> 
    </div>
</section>

    <footer>
        <div class="container footer-content">
            <div id="copyright">&copy; <?php echo date("Y"); ?> | enem.co Tüm Hakları Saklıdır.</div>
            <div id="socialfooter">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <a href="#Menu" class="back-to-top"><i class="fas fa-angle-up"></i></a>
        </div>
    </footer>

</body>
</html>