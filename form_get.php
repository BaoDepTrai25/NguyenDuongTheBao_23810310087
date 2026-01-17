<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form GET</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        form { margin: 20px 0; padding: 20px; border: 1px solid #ccc; }
        input { padding: 8px; margin: 5px; }
        button { padding: 8px 15px; background: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
    <h1>📋 Form Tìm Kiếm (GET)</h1>
    
    <form method="GET" action="">
        <label for="keyword">Nhập từ khóa:</label><br>
        <input type="text" id="keyword" name="keyword" placeholder="Ví dụ: PHP, MySQL..." required>
        <button type="submit">🔍 Tìm kiếm</button>
    </form>

    <?php
    // Kiểm tra xem có từ khóa được gửi lên không
    if (isset($_GET['keyword'])) {
        // Lấy từ khóa và làm sạch
        $keyword = htmlspecialchars($_GET['keyword']);
        echo "<h3>🔎 Kết quả tìm kiếm:</h3>";
        echo "<p>Bạn đang tìm kiếm từ khóa: <strong style='color:red'>$keyword</strong></p>";
        
        echo "<h4>📌 Quan sát URL:</h4>";
        echo "<p>URL hiện tại: <code>" . $_SERVER['REQUEST_URI'] . "</code></p>";
        echo "<p><em>→ URL chứa từ khóa, mọi người có thể nhìn thấy!</em></p>";
    }
    ?>
    
    <hr>
    <p><a href="form_post.php">👉 Chuyển sang Form POST</a></p>
    <p><a href="add_student.php">👉 Đến trang thêm sinh viên</a></p>
</body>
</html>