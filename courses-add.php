<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");
                 // run sql                 // get data from ... ?
$teachers = $db->query("SELECT id , name FROM teachers")->fetchAll(PDO::FETCH_ASSOC); // 从 teachers table 取得老师的 ID 和名字

if(isset($_POST['add'])){ // 检查 Add button 有没有被按?
    $name = $_POST['name']; // get the name 
    $description = $_POST['description'];
    $teacher_id = $_POST['teacher_id'];

    $statement = $db->prepare("INSERT INTO courses (name, description, teacher_id) VALUES (?, ?, ?)");
    $statement->execute([$name, $description, $teacher_id]); // run SQL，把资料加入数据库

    header("Location: manage-courses.php");  
    exit; // stop script
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
    <div class="container py-5">
        <h1>Add courses</h1>
        <p>Add student information</p>
        <div class="student-box">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Courses_name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your Course_name">
                </div>
                <div class="mb-3">
                    <label for="">Description:</label>
                    <textarea name="description" rows="5" class="form-control" placeholder="Enter your description"></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Teacher_Name:</label>
                    <select name="teacher_id" class="form-control">
                        <?php foreach($teachers as $teacher): ?>   <!-- 一个一个显示老师 -->
                            <option value="<?= $teacher['id'] ?>"> <!-- 保存老师的 ID -->
                                <?= $teacher['name'] ?>  <!-- 显示老师的名字 -->
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-outline-success" type="submit" name="add">Add courses</button>
                <a href="manage-courses.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>