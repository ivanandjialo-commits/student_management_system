<?php
session_start();

$db = new PDO("mysql:host=localhost;dbname=student_management_system;", "root", "");

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_POST["username"] ?? ""; // got username will get it , if no will empty
$password = $_POST["password"] ?? ""; // if no "??""" = may show an error

    $statement = $db->prepare("SELECT * FROM users WHERE username = ?");
    $statement->execute([$username]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $_SESSION["user"] = $user;

        if($user["role"] == "admin"){
            header("Location: admin.php");
        } else {
            header("Location: users.php");
        }
        exit;
    } else {
        $error = "Username or password in wrong , Please try again";
    }
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
            background-image: url("assets/ChatGPT Image Sep 24, 2026, 11_13_11 PM.png");
            background-repeat: no-repeat;
            height: 92vh;
            background-size: cover;
        }
        .title{
            color: blue;
            font-weight: bold;
        }
        .description{
            color: lightgrey;
        }
        .login-card{
            border-radius: 20px;
        }
        .form-control{
            padding: 12px;
            border-radius: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1 class="title">Student Management System</h1>
            <p class="description">Welcome! Please login first</p>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="height: 500px;">
            <div class="col-md-5">
                <div class="card login-card p-3">
                <h1 class="text-center">Login</h1>
                <?php if($error): ?>
                    <div class="alert alert-danger">
                        <p><?= $error ?></p>
                    </div>
                    <?php endif; ?>
                    <form action="login.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Name:</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter your username">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="******">
                        </div>

                        <button class="btn btn-primary w-100">Login</button>
                    </form>
                    <p class="text-center mt-3">Not account? Please <a href="register.php">click here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>