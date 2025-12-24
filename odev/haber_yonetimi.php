<?php
session_start();
include 'baglan.php';

// Yetki Kontrolü
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'editor')) {
    header("Location: index.php"); exit();
}

$haberler = $db->query("SELECT * FROM haberler ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <title>Haberleri Yönet</title>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-tasks text-primary me-2"></i> Haberleri Yönet</h2>
            <a href="panel.php" class="btn btn-secondary btn-sm">Panele Dön</a>
        </div>
        
        <div class="card shadow border-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Görsel</th>
                            <th>Başlık</th>
                            <th>Özet</th>
                            <th class="text-center">İşlem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($haberler as $h): ?>
                        <tr>
                            <td><img src="img/<?php echo $h['resim']; ?>" width="80" class="rounded"></td>
                            <td><strong><?php echo htmlspecialchars($h['baslik']); ?></strong></td>
                            <td><?php echo mb_substr(htmlspecialchars($h['ozet']), 0, 50); ?>...</td>
                            <td class="text-center">
                                <a href="haber_sil.php?id=<?php echo $h['id']; ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Bu haberi silmek istediğinize emin misiniz?')">
                                   <i class="fas fa-trash"></i> Sil
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>