<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", ""); //connect database

$id = $_SESSION['user']['id']; // 获取当前登录用户的 ID

$statement = $db->prepare("SELECT * FROM users WHERE id = ?"); // 准备查找指定 ID 的用户资料
$statement->execute([$id]); // 执行 SQL
$user = $statement->fetch(PDO::FETCH_ASSOC); // 获取一个用户的资料，并保存到 $user

if(isset($_POST['edit'])){ // 检查表单有没有提交
    $username = $_POST['username']; // 获取输入的 Username
    $email = $_POST['email'];
    $password = $_POST['password'];

    if($password == $_POST['confirm_password']){ // 检查新密码和确认密码是否相同
        if($password != ""){ // 检查用户有没有输入新密码
            $password = password_hash($password, PASSWORD_DEFAULT); // 将密码加密后保存
        }else{
            $password = $user['password']; // 如果没有输入新密码，就保留原本的密码
        }

        $statement = $db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?"); // 准备更新
        $statement->execute([$username, $email, $password, $id]); // 执行 SQL

        $_SESSION['user']['username'] = $username; // 更新当前登录用户的用户名

        if($_SESSION['user']['role'] == 'admin'){ // 检查用户是不是管理员
            header("Location: admin.php");
        }else{
            header("Location: users.php");
        }
        exit;
    }else{
        $error = "Password does not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

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

        .profile-box{
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
    </style>
</head>

<body>

<div class="container py-5">

    <h1 class="title">My Profile</h1>
    <p class="description">Edit your account information</p>

    <div class="profile-box">

        <?php if(isset($error)){ ?>
            <p class="text-danger"><?= $error ?></p>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label>Username:</label>
                <input type="text" name="username" class="form-control"
                       value="<?= $user['username'] ?>"> <!-- 显示原本的 Username -->
            </div>

            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control"
                       value="<?= $user['email'] ?>">
            </div>

            <div class="mb-3">
                <label>New Password:</label>
                <input type="password" name="password" class="form-control"
                       placeholder="Please enter new password">
            </div>

            <div class="mb-3">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Please Confirm New Password">
            </div>

            <button class="btn btn-outline-success" type="submit" name="edit">
                Update Profile
            </button>

            <?php if($_SESSION['user']['role'] == 'admin'){ ?>
                <a href="admin.php" class="btn btn-outline-danger">Back</a>
            <?php }else{ ?>
                <a href="users.php" class="btn btn-outline-danger">Back</a>
            <?php } ?>

        </form>
    </div>
</div>

</body>
</html>
<!-- <p></p> -->