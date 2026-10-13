<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", ""); // connect database
                 // run sql                 // 从 teachers 表获取资料
$teachers = $db->query("SELECT id , name FROM teachers")->fetchAll(PDO::FETCH_ASSOC); // 获取所有老师的 ID 和名字

if(isset($_POST['add'])){ // 检查 Add button 有没有被按?
    $name = $_POST['name']; // 获取课程名称
    $description = $_POST['description'];
    $teacher_id = $_POST['teacher_id'];

    $statement = $db->prepare("INSERT INTO courses (name, description, teacher_id) VALUES (?, ?, ?)"); // 准备 SQL
    $statement->execute([$name, $description, $teacher_id]); // run SQL，保存课程资料

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

    .course-box{
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
        <h1>Add courses</h1>
        <p>Add student information</p>
        <div class="course-box">
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