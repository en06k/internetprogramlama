<?php
session_start();
include 'baglan.php';

// Sadece Admin görebilir
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php"); exit();
}

$mesajlar = $db->query("SELECT * FROM iletisim_mesajlari ORDER BY tarih DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <title>Gelen Mesajlar</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-envelope-open-text text-primary me-2"></i> Gelen Mesajlar</h2>
            <a href="panel.php" class="btn btn-secondary btn-sm">Panele Dön</a>
        </div>
        
        <div class="card shadow border-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>İsim</th>
                            <th>Email / Tel</th>
                            <th>Konu</th>
                            <th>Mesaj</th>
                            <th>Tarih</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($mesajlar as $m): ?>
                        <tr>
                            <td><strong><?php echo $m['isim']; ?></strong></td>
                            <td><small><?php echo $m['email']; ?><br><?php echo $m['telefon']; ?></small></td>
                            <td><span class="badge bg-info text-dark"><?php echo $m['konu']; ?></span></td>
                            <td><p class="small mb-0" style="max-width:300px;"><?php echo $m['mesaj']; ?></p></td>
                            <td><small class="text-muted"><?php echo date('d.m.Y H:i', strtotime($m['tarih'])); ?></small></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>