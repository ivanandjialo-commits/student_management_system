<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system","root", ""); // connect database

$id = $_GET['id']; // 从 URL 获取 User ID

$statement = $db->prepare("SELECT * FROM users WHERE id = ?"); // 准备查找指定 ID 的用户
$statement->execute([$id]); // 执行 SQL
$user = $statement->fetch(PDO::FETCH_ASSOC); // 获取一个用户的资料

if(isset($_POST['edit'])){ // 检查表单有没有提交
    $username = $_POST['username']; // 获取输入的 Username
    $email = $_POST['email'];
    $role = $_POST['role'];

    $statement = $db->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?"); // 准备更新用户的 Username、Email 和 Role
    $statement->execute([$username, $email, $role, $id]); // 执行 SQL

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

    .users-box{
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
        <h1 class="title">Edit User</h1>
        <p class="description">Edit Users Information</p>
        <div class="users-box">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Username:</label>
                    <input type="username" value="<?= $user['username'] ?>" name="username" class="form-control" placeholder="Enter User Username">
                                           <!-- 显示原本的 Username -->
                </div>
                <div class="mb-3">
                    <label for="">Email:</label>
                    <input type="email" value="<?= $user['email'] ?>" name="email" class="form-control" placeholder="Enter User Email">
                </div>
                <div class="mb-3">
                    <label for="">Role:</label>
                    <select name="role" class="form-control">
                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                                 <!-- 如果用户原本是 Admin，就自动选择 Admin -->
                        <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-outline-success me-2" name="edit">Edit User</button>
                <a href="manage-user.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>