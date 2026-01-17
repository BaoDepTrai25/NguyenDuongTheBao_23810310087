 <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Form POST</title>
    <style>
        body { font-family: Arial; margin: 50px; }
        form { margin: 20px 0; padding: 20px; border: 1px solid #ccc; }
        input { padding: 8px; margin: 5px; display: block; }
        button { padding: 8px 15px; background: #2196F3; color: white; border: none; }
    </style>
</head>
<body>
    <h1>📝 Form Đăng Ký (POST)</h1>
    
    <form method="POST" action="">
        <label for="name">Tên của bạn:</label>
        <input type="text" id="name" name="name" placeholder="Nhập tên..." required>
        
        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu..." required>
        
        <button type="submit">📤 Gửi thông tin</button>
    </form>

    <?php
    // Kiểm tra xem form có được submit không
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ form
        $name = htmlspecialchars($_POST['name']);
        
        echo "<h3>✅ Thông tin đã nhận:</h3>";
        echo "<p>Đã nhận thông tin của: <strong style='color:blue'>$name</strong></p>";
        
        echo "<h4>🔒 Quan sát bảo mật:</h4>";
        echo "<p>URL hiện tại: <code>" . $_SERVER['REQUEST_URI'] . "</code></p>";
        echo "<p><em>→ URL KHÔNG chứa mật khẩu, an toàn hơn!</em></p>";
    }
    ?>
    
    <hr>
    <h3>📊 So sánh GET vs POST:</h3>
    <table border="1" cellpadding="10">
        <tr>
            <th>Phương thức</th>
            <th>GET</th>
            <th>POST</th>
        </tr>
        <tr>
            <td>Dữ liệu trong URL</td>
            <td>✅ Có</td>
            <td>❌ Không</td>
        </tr>
        <tr>
            <td>Bảo mật</td>
            <td>❌ Kém</td>
            <td>✅ Tốt hơn</td>
        </tr>
        <tr>
            <td>Dung lượng</td>
            <td>Giới hạn</td>
            <td>Không giới hạn</td>
        </tr>
        <tr>
            <td>Mục đích sử dụng</td>
            <td>Tìm kiếm, lọc</td>
            <td>Đăng ký, đăng nhập</td>
        </tr>
    </table>
    
    <hr>
    <p><a href="form_get.php">👈 Quay lại Form GET</a></p>
    <p><a href="add_student.php">👉 Đến trang thêm sinh viên</a></p>
</body>
</html>