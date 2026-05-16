<?php
require_once 'config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO decks (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);
    $deck_id = $conn->lastInsertId();
    if (!empty($_POST['front'])) {
        $fronts = $_POST['front'];
        $backs = $_POST['back'];
        $stmtCard = $conn->prepare("INSERT INTO cards (deck_id, front_side, back_side) VALUES (?, ?, ?)");
        for ($i = 0; $i < count($fronts); $i++) {
            if (!empty($fronts[$i]) && !empty($backs[$i])) {
                $stmtCard->execute([$deck_id, $fronts[$i], $backs[$i]]);
            }
        }
    }
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đóng góp Flashcard mới</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn btn-back">← Hủy bỏ</a>
        <h1>Tạo & Chia Sẻ Bộ Flashcard</h1>
        <form action="" method="POST">
            <h3>1. Tiêu đề dự án thẻ</h3>
            <input type="text" name="title" required placeholder="Ví dụ: Lập trình PHP Cơ Bản">
            <h3>2. Mô tả dự án</h3>
            <textarea name="description" rows="3" placeholder="Ghi chú tóm tắt..."></textarea>
            <h3>3. Danh sách các thẻ con</h3>
            <div id="cardInputs">
                <div class="card-input-group">
                    <h4>Thẻ số 1</h4>
                    <input type="text" name="front[]" placeholder="Mặt trước" required>
                    <input type="text" name="back[]" placeholder="Mặt sau" required>
                </div>
            </div>
            <button type="button" class="btn" onclick="addMoreCardInput()" style="background-color: #3498db; margin-bottom: 20px;">+ Thêm thẻ mới</button>
            <br>
            <button type="submit" class="btn" style="width: 100%; padding: 15px; font-size: 18px;">🚀 Phát hành lên Cộng đồng</button>
        </form>
    </div>
    <script>
        let cardCount = 1;
        function addMoreCardInput() {
            cardCount++;
            const container = document.getElementById('cardInputs');
            const div = document.createElement('div');
            div.className = 'card-input-group';
            div.innerHTML = `<h4>Thẻ số ${cardCount}</h4><input type="text" name="front[]" placeholder="Mặt trước" required><input type="text" name="back[]" placeholder="Mặt sau" required>`;
            container.appendChild(div);
        }
    </script>
</body>
</html>