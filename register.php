<?php
session_start();

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

$success = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $statement = $db->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $statement->execute([$username, $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if($user){
        $error = "Username or email already exists";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT); // protect the password
    

    $statement = $db->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");

    $statement->execute([$username, $email, $password]); // execute()= run query

    $success = "Register sucessful! You can login";
    header("Location: login.php");
    exit;
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
        .card-login{
            border-radius: 15px;
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
            <p class="description">Welcome! if you not account Please Sign In.</p>
        </div>
        <div class="d-flex justify-content-center align-items-center" style="height: 550px;">
                <div class="col-md-5">
                    <div class="card card-login p-3">
                        <h2 class="text-center">Register</h2>
                        <form action="register.php" method="POST">
                            <div class="mb-3">
                                <label for="form-label">Username:</label>
                                <input type="username" name="username" class="form-control" placeholder="Enter your username">
                            </div>
                            <div class="mb-3">
                                <label for="form-label">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your Email">
                            </div>
                            <div class="mb-3">
                                <label for="form-label">Password:</label>
                                <input type="password" name="password" class="form-control" placeholder="******">
                            </div>
                            <button class="btn btn-primary w-100">Register</button>
                        </form>
                        <p class="text-center mt-3">If you got account? Please <a href="login.php">Click here</a></p>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>