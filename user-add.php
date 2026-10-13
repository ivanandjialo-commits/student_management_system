<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", ""); // connect database

if(isset($_POST['add'])){ // 检查用户有没有提交 Add User 表单
    $username = $_POST['username']; // 获取用户输入的 Username
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 获取用户输入的密码，并进行 Hash 处理
    $role = $_POST['role'];

    $statement = $db->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)"); // 准备把新用户资料加入 users 表
    $statement->execute([$username, $email, $password, $role]); // 执行 SQL

    header("Location: manage-user.php");
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

    .user-list{
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
        <h1 class="title">Add User</h1>
        <p class="description">Add user information</p>
        <div class="user-list">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Username:</label>
                    <input type="text" name="username" class="form-control" placeholder="Enter User Username">
                </div>
                <div class="mb-3">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter User Email">
                </div>
                <div class="mb-3">
                    <label for="">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter User Password">
                </div>
                <div class="mb-3">
                    <label for="">Role:</label>
                    <select name="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <button class="btn btn-outline-success me-2" name="add">Add User</button>
                <a href="manage-user.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>