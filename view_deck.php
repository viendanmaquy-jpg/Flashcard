<?php
require_once 'config/db.php';
$deck_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $conn->prepare("SELECT * FROM decks WHERE id = ?");
$stmt->execute([$deck_id]);
$deck = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$deck) { die("Bộ thẻ không tồn tại!"); }
$stmt = $conn->prepare("SELECT * FROM cards WHERE deck_id = ?");
$stmt->execute([$deck_id]);
$cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($deck['title']) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn btn-back">← Quay lại trang chủ</a>
        <h2><?= htmlspecialchars($deck['title']) ?></h2>
        <p style="color: #666; font-style: italic;"><?= htmlspecialchars($deck['description']) ?></p>
        <?php if(empty($cards)): ?>
            <p style="text-align:center; color: red;">Bộ thẻ này chưa có nội dung!</p>
        <?php else: ?>
            <div class="flashcard-wrapper" onclick="flipCard()">
                <div class="flashcard" id="cardBox">
                    <div class="card-face card-front" id="frontText">Mặt trước</div>
                    <div class="card-face card-back" id="backText">Mặt sau</div>
                </div>
            </div>
            <div class="controls">
                <button onclick="prevCard()">◀ Thẻ trước</button>
                <span id="cardIndex" style="font-weight:bold; font-size: 18px;">1/1</span>
                <button onclick="nextCard()">Thẻ sau ▶</button>
            </div>
        <?php endif; ?>
    </div>
    <script>
        const cards = <?= json_encode($cards) ?>;
        let currentIndex = 0;
        function updateCard() {
            if(cards.length === 0) return;
            document.getElementById('cardBox').classList.remove('flipped');
            setTimeout(() => {
                document.getElementById('frontText').innerText = cards[currentIndex].front_side;
                document.getElementById('backText').innerText = cards[currentIndex].back_side;
                document.getElementById('cardIndex').innerText = `${currentIndex + 1} / ${cards.length}`;
            }, 150);
        }
        function flipCard() { document.getElementById('cardBox').classList.toggle('flipped'); }
        function nextCard() { if (currentIndex < cards.length - 1) { currentIndex++; updateCard(); } }
        function prevCard() { if (currentIndex > 0) { currentIndex--; updateCard(); } }
        updateCard();
    </script>
</body>
</html>