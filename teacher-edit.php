<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root","");

$id = $_GET['id']; // 获取 URL 中的老师 ID // URL ?id=1

$statement = $db->prepare("SELECT * FROM teachers WHERE id = ?"); // 准备SQL 根据 ID 找老师资料
$statement->execute([$id]); // 执行 SQL
$teacher = $statement->fetch(PDO::FETCH_ASSOC);  // 获取一位老师的资料

if(isset($_POST['edit'])){ // 检查是否点击 Edit 按钮
    $name = $_POST['name']; // 获取输入的老师名字
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $statement = $db->prepare("UPDATE teachers SET name = ? , email = ? , phone = ? WHERE id = ?"); // 准备更新老师资料
    $statement->execute([$name, $email, $phone, $id]);  // 执行 SQL

    header("Location: manage-teacher.php");
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

    .teacher-box{
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
    <div class="container py-5">
        <h1 class="title">Edit Teacher</h1>
        <p class="description">Edit teacher information</p>
        <div class="teacher-box">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= $teacher['name'] ?>">
                                                                         <!-- 显示老师原本的名字 -->
                </div>
                <div class="mb-3">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?= $teacher['email'] ?>">
                </div>
                <div class="mb-3">
                    <label for="">Phone:</label>
                    <input type="phone" name="phone" class="form-control" value="<?= $teacher['phone'] ?>">
                </div>
                <button class="btn btn-outline-success" name="edit" type="submit">Edit student</button>
                <a href="manage-teacher.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->