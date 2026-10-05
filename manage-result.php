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
            background-color: #eff6ff;
        }
        .title{
            color: #1e40af;
            font-weight: bold;
        }
        .description{
            color: #64748b;
        }
        .result-list{
            background: white;
            padding: 25px;
            border-radius: 20px;
        }
        .table thead th{
            background: #1e40af;
            color: white;
            padding: 10px;
        }
        .table tbody td{  
            padding: 15px;
             vertical-align: middle; /* make center */ 
        }
        .table tbody tr:hover td{ 
            background-color: #99d0e9; 
            color: white;
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
                    <a href="result-add.php" class="btn btn-outline-success me-2">
                        <i class="bi bi-plus-lg"></i> Add</a>
                    <a href="admin.php" class="btn btn-outline-danger">Back</a>
                </div>        
            </div>
            <table class="table">
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
                                <a href="" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="manage-result.php?delete=<?= $result['id'] ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i></a>
                                                                      <!-- 把 Result ID 放进 URL，然后删除 -->
                            </td>  
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
</body>
</html>
<!-- <p></p> -->