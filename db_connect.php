<?php
// 📌 THÔNG TIN KẾT NỐI DATABASE
$host = 'localhost';      // Server database
$dbname = 'buoi2_php';   // Tên database bạn đã tạo
$username = 'root';       // Tên đăng nhập MySQL (mặc định của XAMPP)
$password = '';           // Mật khẩu MySQL (mặc định để trống)

echo "<h3>🔗 Đang thử kết nối database...</h3>";
echo "<p>Database: $dbname</p>";
echo "<p>Username: $username</p>";

try {
    // Tạo kết nối PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Thiết lập chế độ báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Thiết lập charset UTF-8
    $conn->exec("SET NAMES 'utf8'");
    
    echo "<p style='color:green;'>✅ Kết nối database thành công!</p>";
    
} catch (PDOException $e) {
    // HIỂN THỊ THÔNG BÁO LỖI THÂN THIỆN
    echo "<div style='background-color:#f8d7da; color:#721c24; padding:15px; border:1px solid #f5c6cb;'>";
    echo "<h3>⚠️ Lỗi kết nối database!</h3>";
    echo "<p><strong>Hệ thống đang bảo trì, vui lòng quay lại sau.</strong></p>";
    
    // Phần này chỉ để debug, thực tế nên ẩn đi
    echo "<hr>";
    echo "<p><small>Thông tin lỗi (chỉ hiển thị khi debug):</small></p>";
    echo "<p>Mã lỗi: " . $e->getCode() . "</p>";
    echo "<p>Nội dung: " . $e->getMessage() . "</p>";
    echo "</div>";
    
    // Dừng chương trình
    die();
}

// Lưu ý: Trong file thực tế, KHÔNG nên echo gì cả
// Nhưng để bạn dễ hiểu, tôi để lại các echo này
?>