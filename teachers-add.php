<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

if(isset($_POST['add'])){
    $name = $_POST['name']; // get the name by user
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $statement = $db->prepare("INSERT INTO teachers (name, email, phone) VALUES (?, ?, ?)"); // prepare the SQL
    $statement->execute([$name, $email, $phone]); // put data in ? 

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
    </style>
</head>
<body>
    <div class="container py-5"> <!-- py-5 : padding: 48px -->
        <h1 class="title">Add Teachers</h1>
        <p class="description">Add teachers information</p>
        <div class="student-box">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="">Phone:</label>
                    <input type="phone" name="phone" class="form-control" placeholder="Enter your phone">
                </div>
                <button name="add" class="btn btn-outline-success">Add Teachers</button>
                <a href="manage-teacher.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>