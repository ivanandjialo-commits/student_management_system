<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

if(isset($_GET['delete'])){ //检查 URL 有没有 delete = ？
    $id = $_GET['delete']; // 取得要删除的 student ID

    $statement = $db->prepare("DELETE FROM student WHERE id = ?"); // prepare to delete
    $statement->execute([$id]); // 执行删除

    header("Location: manage-student.php");
    exit;
}

$statement = $db->prepare("SELECT * FROM student"); // get data
$statement->execute(); // run the sql
$students = $statement->fetchAll(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC ：get data using column names
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
        .student-box{
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
        <div class="manage-student">
            <h1 class="title">Manage Students</h1>
            <p class="description">Manage student information</p>
        </div>

        <div class="student-box">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Manage List</h4>
                <div>
                    <a href="student-add.php" class="btn btn-outline-success me-2">
                        <i class="bi bi-plus-lg"></i>Add
                    </a>
                    <a href="admin.php" class="btn btn-outline-danger">Back</a>
                </div>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach($students as $student): ?> <!-- 一个一个显示老师 -->
                        <tr>
                            <td><?= $student['id'] ?></td> <!-- show the student name -->
                            <td><?= $student['name'] ?></td>
                            <td><?= $student['email'] ?></td>
                            <td><?= $student['phone'] ?></td>
                            <td>
                            <a href="student-edit.php?id=<?= $student['id'] ?>" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></a>
                            <a href="manage-student.php?delete=<?= $student['id'] ?>" class="btn btn-outline-warning"><i class="bi bi-trash"></i></a>  <!-- ?delete= tell php, get the id  -->
                            </td>
                        </tr>
                        <?php endforeach; ?> <!-- foreach loop  -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>