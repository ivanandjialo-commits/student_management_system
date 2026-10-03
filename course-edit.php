<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", ""); // connect database

$id = $_GET['id']; // 从 URL 获取 course 的 ID

$statement = $db->prepare("SELECT * FROM courses WHERE id = ?"); // 准备 SQL，找出指定 ID 的 course。
$statement->execute([$id]); // run SQL, put id in ?
$course = $statement->fetch(PDO::FETCH_ASSOC); // get data from SQL

if(isset($_POST['edit'])){ // 检查用户有没有按 Edit
    $name = $_POST['name']; // 获取用户输入的 Course Name
    $description = $_POST['description'];
    $teacher_id = $_POST['teacher_id'];

    $statement = $db->prepare("UPDATE courses SET name = ?, description = ?, teacher_id = ? WHERE id = ?"); // 准备 SQL 来更新 course
    $statement->execute([$name, $description, $teacher_id, $id]); // 执行更新，把新的资料放进数据库

    header("Location: manage-courses.php");
    exit;
}
                // run SQL                                       // Gets the data as an array
$teachers = $db->query("SELECT id, name FROM teachers")->fetchAll(PDO::FETCH_ASSOC); // 从 teachers table 表取得所有老师
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
        <h1 class="title">Edit Course</h1>
        <p class="description">Edit courses information</p>
        <div class="student-box">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Course_Name:</label>
                    <input type="text" name="name" value="<?= $course['name'] ?>" class="form-control"> <!-- 显示原本的课程名称 -->
                </div>
                <div class="mb-3">
                    <label for="">Description:</label>
                    <textarea name="description" rows="5" class="form-control"><?= $course['description'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Teacher_Name</label>
                    <select name="teacher_id" class="form-control">
                        <?php foreach($teachers as $teacher): ?><!-- 一个一个读取老师 -->
                            <option value="<?= $teacher['id'] ?>" 
                            <?= $teacher['id'] == $course['teacher_id'] ? 'selected' : '' ?>> <!-- 如果是当前老师，就选中 -->
                            <?= $teacher['name'] ?> <!-- 显示老师名字 -->
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button name="edit" class="btn btn-outline-success">Edit Course</button>
                <a href="manage-courses.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->