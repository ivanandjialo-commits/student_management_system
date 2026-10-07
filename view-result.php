<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");  // connect database

$user = $_SESSION['user']; // 获取登录用户

                    // 获取 Result ID
                    // 获取学生名字，并叫它 student_name
                    // 获取分数
                //FROM results: 从 results table 获取资料
                // 连接 results 和 student table
                // 只找指定学生的 Result
$statement = $db->prepare("
                    SELECT 
                        results.id,
                        student.name AS student_name,
                        courses.name AS course_name,
                        results.marks,
                        results.grade
                    FROM results
                    JOIN student ON results.student_id = student.id
                    JOIN courses ON results.course_id = courses.id
                    WHERE student.name = ?
                    ");
$statement->execute([$user['username']]);// 执行 SQL
           // SQL query
$results = $statement->fetchAll(PDO::FETCH_ASSOC); // 获取所有找到的 Result // PDO::FETCH_ASSOC: 用字段名称来读取资料
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body{
            background-color: #f1f5f9;
        }
        .result-card{ 
            border: none; 
            border-radius: 20px; 
            padding: 30px; 
        } 
        h1{ 
            color: #1e3a8a; 
            font-weight: bold; 
            margin-bottom: 25px; 
        } 
        .table thead th{
            background-color: #1e3a8a;
            color: white;
        } 
        .grade{ 
            font-weight: bold; 
            color: #2563eb; 
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="card result-card">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="mb-0">My Results</h1>

                    <a href="grade-book.php" class="btn btn-outline-info">
                        <i class="bi bi-book"></i> Grade Book
                    </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Course</th>
                            <th>Marks</th>
                            <th>Grade</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($results as $result): ?> <!-- 一个一个读取 Result -->
                            <tr>
                                <td><?= $result['student_name'] ?></td> <!-- 显示学生名字 --> 
                                <td><?= $result['course_name'] ?></td>
                                <td><?= $result['marks'] ?></td>
                                <td>
                                    <span class="grade">
                                        <?= $result['grade'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <div class="text-center">
                <a href="users.php" class="btn btn-outline-danger">Back</a>
            </div>
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->