<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", ""); 

if(isset($_GET['delete'])){ // 检查 URL 有没有 delete = ？
    $id = $_GET['delete']; // 取得要删除的 Result ID

    $statement = $db->prepare("DELETE FROM results WHERE id = ?"); // 准备删除指定的 Result
    $statement->execute([$id]); // 执行删除

    header("Location: manage-result.php");
    exit;
}
                          // 取得 Results 表的所有资料
                          // 取得学生名字，并命名为 student_name
                          // 取得课程名字，并命名为 course_name
                          // 从 results 表取得资料
                          // 连接 Result 和 Student
$statement = $db->prepare("SELECT results.*, 
                            student.name AS student_name,
                            courses.name AS course_name
                            FROM results
                            JOIN student ON results.student_id = student.id
                            JOIN courses ON results.course_id = courses.id
                        ");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC); // 取得所有 Result 资料

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
        .container{
            max-width: 1150px;
        }
        .title{
            color: #1e40af;
            font-weight: bold;
            font-size: 36px;
            margin-bottom: 8px;
        }
        .description{
            color: #64748b;
            margin-bottom: 30px;
        }
        .result-list{
            background: white;
            padding: 30px;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
        }
        .student-box h4{
            color: #1e293b;
            font-weight: bold;
        }
        .table{
            margin-bottom: 0;
        }
        .table thead th{
            background: #1e40af;
            color: white;
            padding: 14px;
        }
        .table tbody td{  
            padding: 15px;
             vertical-align: middle; /* make center */ 
             color: #334155;
        }
        .table tbody tr:hover td{ 
            background-color: #accefb; 
            color: #1e3a8a;
        }
        .btn{
            border-radius: 8px;
        }
        .btn-outline-success{
            padding: 8px 16px;
        }
        .btn-outline-danger{
            padding: 8px 16px;
        }
        .btn-outline-info{
            padding: 8px 16px;
        }
        .btn-outline-primary,
        .btn-outline-warning{
            width: 42px;
            height: 38px;
            padding: 7px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="title">Manage Result</h1>
        <p class="description">Manage student Result Information</p>
        <div class="result-list">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Student Result</h4>
                <div>
                    <a href="grade-book.php" class="btn btn-outline-info me-2">
                        <i class="bi bi-book"></i> Grade book
                    </a>
                    <a href="result-add.php" class="btn btn-outline-success me-2">
                        <i class="bi bi-plus-lg"></i> Add</a>
                </div>        
            </div>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student_Name</th>
                        <th>Courses</th>
                        <th>Score</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($results as $result): ?> <!-- 一个一个读取 Result -->
                        <tr>
                            <td><?= $result['id'] ?></td>
                            <td><?= $result['student_name'] ?></td> <!-- dispaly the student name -->
                            <td><?= $result['course_name'] ?></td>
                            <td><?= $result['marks'] ?></td> 
                            <td><?= $result['grade'] ?></td> 
                            <td>
                                <a href="result-edit.php?id=<?= $result['id'] ?>" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="manage-result.php?delete=<?= $result['id'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
                                                           <!-- 把 Result ID 放进 URL，然后删除 -->
                            </td>  
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>                
            <div class="text-center mt-3">
                    <a href="admin.php" class="btn btn-outline-danger">Back</a>
            </div>
        </div>
</body>
</html>