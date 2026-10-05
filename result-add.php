<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

$students = $db->query("SELECT id, name FROM student")->fetchAll(PDO::FETCH_ASSOC); // 取得所有学生的 ID 和名字
$courses = $db->query("SELECT id, name FROM courses")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['add'])){ // 检查用户有没有按 Add Resul
    $student_id = $_POST['student_id']; // 取得学生 ID  
    $course_id = $_POST['course_id'];
    $marks = $_POST['marks'];
    $grade = $_POST['grade'];
                                                                                               // 等待资料
    $statement = $db->prepare("INSERT INTO results(student_id, course_id, marks, grade) VALUES (?, ?, ? ,?)"); // 准备把 Result 加入数据库
    $statement->execute([$student_id, $course_id, $marks, $grade]); // 执行 SQL

    header("Location: manage-result.php");
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
        <h1 class="title">Add Result</h1>
        <p class="description">Add result information</p>
        <div class="student-box">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Student_Name:</label>
                    <select name="student_id" class="form-control">
                        <?php foreach($students as $student): ?> <!-- 一个一个读取学生 -->
                            <option value="<?= $student['id'] ?>"> <!-- 保存学生 ID -->
                                <?= $student['name'] ?> <!-- 显示学生名字 -->
                            </option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Course_Name:</label>
                    <select name="course_id" class="form-control">
                        <?php foreach($courses as $course): ?>
                            <option value="<?= $course['id'] ?>">
                                <?= $course['name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Score:</label>
                    <input type="number" name="marks" class="form-control" placeholder="Enter student course">
                </div>
                <div class="mb-3">
                    <label for="">Grade:</label>
                    <input type="text" name="grade" class="form-control" placeholder="Enter student course">
                </div>
                <button class="btn btn-outline-success" name="add">Add Result</button>
                <a href="manage-result.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->