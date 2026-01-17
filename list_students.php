<?php
require_once 'db_connect.php';

try {
    // Lấy tất cả sinh viên từ database
    $sql = "SELECT * FROM students ORDER BY id DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy dữ liệu dưới dạng mảng
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("<div style='color:red; padding:20px;'>Lỗi khi lấy dữ liệu: " . $e->getMessage() . "</div>");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #89f7fe 0%, #66a6ff 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eaeaea;
        }
        
        h1 {
            color: #2c3e50;
            font-size: 28px;
        }
        
        .add-btn {
            background: linear-gradient(to right, #00b09b, #96c93d);
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .add-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 176, 155, 0.3);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        th {
            background: linear-gradient(to right, #3498db, #2980b9);
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        
        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e8f4fc;
            transform: scale(1.005);
            transition: transform 0.2s;
        }
        
        .action-links {
            display: flex;
            gap: 10px;
        }
        
        .edit-btn, .delete-btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .edit-btn {
            background-color: #3498db;
            color: white;
        }
        
        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #2980b9;
        }
        
        .delete-btn:hover {
            background-color: #c0392b;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-size: 18px;
        }
        
        .no-data img {
            width: 100px;
            opacity: 0.5;
            margin-bottom: 20px;
        }
        
        .stats {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .count {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .footer-links a {
            text-decoration: none;
            padding: 10px 20px;
            background: #ecf0f1;
            border-radius: 6px;
            color: #34495e;
            transition: all 0.3s;
        }
        
        .footer-links a:hover {
            background: #3498db;
            color: white;
        }
        
        .db-info {
            background: #fff3cd;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 14px;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📚 Danh sách sinh viên</h1>
            <a href="add_student.php" class="add-btn">➕ Thêm sinh viên mới</a>
        </div>
        
        <div class="stats">
            <div>
                <span class="count"><?php echo count($students); ?></span> sinh viên
            </div>
            <div class="db-info">
                📊 Database: buoi2_php | Table: students
            </div>
        </div>
        
        <?php if (count($students) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Mã sinh viên</th>
                        <th>Email</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['id']); ?></td>
                            <td><strong><?php echo htmlspecialchars($student['fullname']); ?></strong></td>
                            <td><code><?php echo htmlspecialchars($student['student_code']); ?></code></td>
                            <td><?php echo htmlspecialchars($student['email']); ?></td>
                            <td class="action-links">
                                <a href="#" class="edit-btn">✏️ Sửa</a>
                                <a href="#" class="delete-btn">🗑️ Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-data">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' width='100' height='100'%3E%3Cpath fill='%23ccc' d='M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z'/%3E%3C/svg%3E" alt="No data">
                <p>📭 Chưa có sinh viên nào trong hệ thống.</p>
                <p style="margin-top: 10px;"><a href="add_student.php" style="color: #3498db;">👉 Click để thêm sinh viên đầu tiên</a></p>
            </div>
        <?php endif; ?>
        
        <div class="footer-links">
            <a href="add_student.php">Thêm sinh viên</a>
            <a href="form_get.php">Form GET</a>
            <a href="form_post.php">Form POST</a>
            <a href="db_connect.php">Test kết nối DB</a>
        </div>
        
        <div style="margin-top: 30px; padding: 15px; background: #f8f9fa; border-radius: 8px;">
            <h3>📝 Hướng dẫn sử dụng:</h3>
            <ol style="margin-left: 20px; margin-top: 10px;">
                <li>Click <strong>"Thêm sinh viên mới"</strong> để thêm dữ liệu</li>
                <li>Test SQL Injection bằng cách nhập: <code>Nguyễn Văn ' A</code></li>
                <li>Xem URL khi dùng GET vs POST</li>
                <li>Quan sát cách dữ liệu được hiển thị an toàn</li>
            </ol>
        </div>
    </div>
</body>
</html>