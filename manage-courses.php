<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

if(isset($_GET['delete'])){ // 检查 URL 有没有删除 ID
    $id = $_GET['delete']; // 获取要删除的课程 ID

    $statement = $db->prepare("DELETE FROM courses WHERE id = ?"); // 准备删除指定 ID 的课程
    $statement->execute([$id]); // 执行删除

    header("Location: manage-courses.php");
    exit;
}
                           // 获取 courses 表的所有资料
                           // 获取老师名字，并命名为 teacher_name
                           // 从 courses 表获取资料
                           // JOIN teachers：连接 teachers 表, 
                           // 用 teacher_id 匹配老师的 id
$statement = $db->prepare("SELECT courses.*,  
                            teachers.name AS teacher_name 
                            FROM courses
                            JOIN teachers 
                            ON courses.teacher_id = teachers.id
");
$statement->execute(); // 执行 SQL
$courses = $statement->fetchAll(PDO::FETCH_ASSOC); // 获取所有 courses 资料
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
        .student-box{
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
        <h1 class="title">Courses List</h1>
        <p class="description">Manage courses information</p>

        <div class="courses-list">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Courses List</h4>
                <div>
                    <a href="courses-add.php" class="btn btn-outline-success me-2">
                        <i class="bi bi-plus-lg"></i>Add
                    </a>
                    <a href="admin.php" class="btn btn-outline-danger">Back</a>
                </div>
            </div>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course_name</th>
                        <th>Description</th>
                        <th>Teacher_Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($courses as $course): ?> <!-- 一个一个显示老师 -->
                        <tr>
                            <td><?= $course['id']?></td>
                            <td><?= $course['name']?></td> <!-- 显示课程的名字 -->
                            <td><?= $course['description']?></td>
                            <td><?= $course['teacher_name']?></td>
                            <td>
                                                        <!-- 传课程 ID 给编辑页面 -->
                                <a href="course-edit.php?id=<?= $course['id'] ?>" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                                <a href="manage-courses.php?delete=<?= $course['id'] ?>" class="btn btn-outline-warning"><i class="bi bi-trash"></i></a> 
                                                        <!-- 把课程 ID 放进 URL，用来删除课程 -->
                            </td>
                        </tr>
                        <?php endforeach; ?> <!-- foreach loop  -->
                </tbody>
            </table> 
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->