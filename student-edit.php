<?php
session_start();

if(!isset($_SESSION['user'])){
    header("header: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

$id = $_GET['id']; // 获取 URL 中的学生 ID

$statement = $db->prepare("SELECT * FROM student WHERE id = ?"); // 准备根据 ID 找学生
$statement->execute([$id]); // 执行 SQL
$student = $statement->fetch(PDO::FETCH_ASSOC); // 获取一位学生的资料

if(isset($_POST['edit'])){ // 检查是否点击 Edit 按钮
    $name = $_POST['name']; // 获取用户输入的 Name
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $statement = $db->prepare("UPDATE student SET name = ? , email = ? , phone = ? WHERE id = ?"); // 准备更新学生资料的 SQL
    $statement->execute([$name, $email, $phone, $id]); // 执行 SQL

    header("Location: manage-student.php");
    exit;
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
        <h1 class="title">Edit Student</h1>
        <p class="description">Edit student information</p>
        <div class="student-box">
            <form method="POST">
                <div class="mb-3"> <!-- 16px -->
                    <label for="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= $student['name'] ?>" placeholder=""> 
                                                                            <!-- 显示原本的学生名字 -->
                </div>
                <div class="mb-3">
                    <label for="form-label">Email:</label>
                    <input type="email " name="email" class="form-control" value="<?= $student['email'] ?>" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="form-label">Phone:</label>
                    <input type="phone" name="phone" class="form-control" value="<?= $student['phone'] ?>" placeholder="">
                </div>
                <button class="btn btn-outline-success" type="submit" name="edit">Edit student</button> 
                <a href="manage-student.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>