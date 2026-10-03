<?php
session_start();

$db = new PDO("mysql:host=localhost;dbname=student_management_system;", "root", ""); // connect database

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
$username = $_POST["username"] ?? ""; // get username, if no will empty
$password = $_POST["password"] ?? ""; // if no "??""" = may show an error

    $statement = $db->prepare("SELECT * FROM users WHERE username = ?"); // prepare the query
    $statement->execute([$username]);

    $user = $statement->fetch(PDO::FETCH_ASSOC); // fetchAll: get all users PDO::FETCH_ASSOC ：get data using column names

    if($user && password_verify($password, $user['password'])){ // User exists + password is correct.  // $user['password'] ： check database
        $_SESSION["user"] = $user;  // $user ： in sql find user data  // $_SESSION: store login data

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body{
            background-image: url("assets/ChatGPT Image Sep 24, 2026, 11_13_11 PM.png");
            background-repeat: no-repeat;
            height: 92vh;
            background-size: cover;
        }
        .title{
            color: white;
            font-weight: bold;
        }
        .description{
            color: white;
        }
        .login-card{
            border: none;
            border-radius: 20px;
            padding: 20px;
        }
        .login-card h1{
            color: #2563eb;
            font-weight: bold;
        }
        .form-control{
            padding: 12px;
            border-radius: 20px;
        }
        .login-card a{
            font-weight: bold;
            text-decoration: none;
        }
        /* .img-fluid{
            border-radius: 50%;
            height: 450px;
            width: 450px;
        } */
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mt-5">
            <h1 class="title">Student Management System</h1>
            <p class="description">Welcome! Please login first</p>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="height: 550px;">
            <!-- <div class="col-md-6">
                <img src="https://p3-sdbk2-media.byteimg.com/tos-cn-i-xv4ileqgde/ea6330a5eaf54ff4bb1c77f85c3b1354~tplv-xv4ileqgde-resize-w:750.image" alt="" class="img-fluid">
            </div> -->
            <div class=" col-md-4">
                <div class="card login-card ">
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

                        <button class="btn btn-primary w-100"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                    </form>
                    <p class="text-center mt-3">Not account? Please <a href="register.php">click here</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>