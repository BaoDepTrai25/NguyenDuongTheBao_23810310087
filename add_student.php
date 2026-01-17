<?php
// Kết nối database
require_once 'db_connect.php';

$message = '';
$message_type = ''; // success hoặc error

// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $fullname = $_POST['fullname'];
    $student_code = $_POST['student_code'];
    $email = $_POST['email'];
    
    try {
        // Sử dụng Prepared Statement để tránh SQL Injection
        $sql = "INSERT INTO students (fullname, student_code, email) 
                VALUES (:fullname, :student_code, :email)";
        
        $stmt = $conn->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':student_code', $student_code);
        $stmt->bindParam(':email', $email);
        
        // Thực thi query
        if ($stmt->execute()) {
            $message = "🎉 Thêm sinh viên thành công!";
            $message_type = "success";
            
            // Reset form sau khi thêm thành công
            $_POST = array();
        }
        
    } catch (PDOException $e) {
        $message = "❌ Lỗi: " . $e->getMessage();
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #667eea;
        }
        
        small {
            display: block;
            margin-top: 5px;
            color: #666;
            font-style: italic;
        }
        
        button {
            background: linear-gradient(to right, #667eea, #764ba2);
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s;
            display: block;
            margin: 0 auto;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
        }
        
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .nav-links {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .nav-links a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        
        .back-link {
            background-color: #6c757d;
            color: white;
        }
        
        .list-link {
            background-color: #28a745;
            color: white;
        }
        
        .nav-links a:hover {
            opacity: 0.9;
        }
        
        .info-box {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>➕ Thêm sinh viên mới</h1>
        
        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <div class="info-box">
            <strong>💡 Thử nghiệm SQL Injection:</strong>
            <p>Nhập tên: <code>Nguyễn Văn ' A</code> (có dấu nháy đơn)</p>
            <p>Nếu thêm thành công → Prepared Statement hoạt động đúng</p>
            <p>Nếu bị lỗi SQL → bạn đang cộng chuỗi thủ công (sai cách)</p>
        </div>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="fullname">👤 Họ tên:</label>
                <input type="text" id="fullname" name="fullname" 
                       value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>"
                       required>
                <small>Ví dụ: Nguyễn Văn A</small>
            </div>
            
            <div class="form-group">
                <label for="student_code">🎓 Mã sinh viên:</label>
                <input type="text" id="student_code" name="student_code" 
                       value="<?php echo isset($_POST['student_code']) ? htmlspecialchars($_POST['student_code']) : ''; ?>"
                       required>
                <small>Ví dụ: B1234567</small>
            </div>
            
            <div class="form-group">
                <label for="email">📧 Email:</label>
                <input type="email" id="email" name="email" 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                       required>
                <small>Ví dụ: student@example.com</small>
            </div>
            
            <button type="submit">💾 Lưu thông tin</button>
        </form>
        
        <div class="nav-links">
            <a href="list_students.php" class="back-link">👈 Danh sách sinh viên</a>
            <a href="list_students.php" class="list-link">📋 Xem danh sách 👉</a>
        </div>
    </div>
</body>
</html>