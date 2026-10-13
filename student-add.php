<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO ("mysql:host=localhost;dbname=student_management_system", "root", ""); // connect database

if(isset($_POST['add'])){ // 检查用户有没有点击 Add 按钮
    $name = $_POST['name']; // 获取用户输入的姓名
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $statement = $db->prepare("INSERT INTO student (name, email, phone) VALUES (?, ?, ?)"); // 准备 SQL
    $statement->execute([$name, $email, $phone]); // 执行 SQL
    
    header("Location: manage-student.php");
    exit; // stop script
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
    body{
        background: #f1f5f9;
        font-family: Arial, sans-serif;
    }

    .container{
        max-width: 800px;
    }

    .title{
        color: #1e40af;
        font-weight: bold;
    }

    .description{
        color: #64748b;
        margin-bottom: 25px;
    }

    .student-box{
        background: white;
        padding: 30px;
        border-radius: 15px;
    }

    label{
        margin-bottom: 8px;
        font-weight: bold;
        color: #334155;
    }

    .form-control{
        padding: 10px;
        border-radius: 8px;
    }

    form .btn{
        padding: 8px 20px;
        border-radius: 8px;
    }
    </style>
</head>
<body>
    <div class="container py-5"> <!-- py-5 ：padding top and bottom -->
        <h1 class="title">Add Student</h1>
        <p class="description">Add new student information</p>

        <div class="student-box">
            <form method="POST">
                <div class="mb-3"> <!-- 16px -->
                    <label for="">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="">Phone:</label>
                    <input type="phone" name="phone" class="form-control" placeholder="Enter your phonenumber">
                </div>
                <button class="btn btn-outline-success" name="add">Add Student</button>
                <a href="manage-student.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->