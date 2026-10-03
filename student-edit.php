<?php
session_start();

if(!isset($_SESSION['user'])){
    header("header: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

$id = $_GET['id']; // URL ?id=1

$statement = $db->prepare("SELECT * FROM student WHERE id = ?"); // find the id
$statement->execute([$id]); // put ID in ?
$student = $statement->fetch(PDO::FETCH_ASSOC); // $student: store data fetch: get data

if(isset($_POST['edit'])){ // check button clicked?
    $name = $_POST['name']; // get edit data
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $statement = $db->prepare("UPDATE student SET name = ? , email = ? , phone = ? WHERE id = ?"); // PREPARE update data
    $statement->execute([$name, $email, $phone, $id]); // put data in ? 

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
    <div class="container py-5"> <!-- py-5 ：padding top and bottom -->
        <h1 class="title">Edit Student</h1>
        <p class="description">Edit student information</p>
        <div class="student-box">
            <form method="POST">
                <div class="mb-3"> <!-- 16px -->
                    <label for="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= $student['name'] ?>" placeholder=""> <!-- value="": 显示原本的学生名字 -->
                </div>
                <div class="mb-3">
                    <label for="form-label">Email:</label>
                    <input type="email " name="email" class="form-control" value="<?= $student['email'] ?>" placeholder="">
                </div>
                <div class="mb-3">
                    <label for="form-label">Phone:</label>
                    <input type="phone" name="phone" class="form-control" value="<?= $student['phone'] ?>" placeholder="">
                </div>
                <button class="btn btn-outline-success" type="submit" name="edit">Edit student</button> <!-- name="edit": gives the button the name edit -->
                <a href="manage-student.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>