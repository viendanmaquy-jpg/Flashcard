<?php
require_once 'config/db.php';
$stmt = $conn->query("SELECT * FROM decks ORDER BY id DESC");
$decks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kho Flashcard Nguồn Mở</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <h1>💡 Kho Flashcard Cộng Đồng Mã Nguồn Mở</h1>
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="create_deck.php" class="btn">+ Tạo & Đóng Góp Bộ Thẻ Mới</a>
        </div>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <h2>Các bộ từ vựng hiện có:</h2>
        <?php if(empty($decks)): ?>
            <p>Kho lưu trữ trống. Hãy tạo bộ thẻ đầu tiên!</p>
        <?php else: ?>
            <?php foreach($decks as $deck): ?>
                <div class="deck-card">
                    <h3><a href="view_deck.php?id=<?= $deck['id'] ?>"><?= htmlspecialchars($deck['title']) ?></a></h3>
                    <p><?= htmlspecialchars($deck['description']) ?></p>
                    <small style="color: #7f8c8d;">Chế độ: <strong>Public (Mã nguồn mở)</strong></small>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>