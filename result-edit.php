<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

$id = $_GET['id']; // 从 URL 获取 Result 的 ID  // example : result-edit.php?id=5

$students = $db->query("SELECT id , name FROM student")->fetchAll(PDO::FETCH_ASSOC); // 从 student table 获取所有学生的 id 和 name
$courses = $db->query("SELECT id , name FROM courses")->fetchAll(PDO::FETCH_ASSOC);

$statement = $db->prepare("SELECT * FROM results WHERE id = ?"); // 准备 SQL，根据 ID 找 Result
$statement->execute([$id]); // 执行 SQL
$result = $statement->fetch(PDO::FETCH_ASSOC); // 获取这个 Result 的资料 

if(isset($_POST['edit'])){ // 检查有没有按 Edit Result
    $student_id = $_POST['student_id']; // 获取选择的学生 ID
    $course_id = $_POST['course_id'];
    $marks = $_POST['marks'];
    $grade = $_POST['grade'];

    $statement = $db->prepare("UPDATE results SET student_id = ?, course_id = ?, marks = ?, grade = ? WHERE id = ?"); // 准备 SQL，更新 Result 的资料
    $statement->execute([$student_id, $course_id, $marks, $grade, $id]); // 执行 SQL

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
    .result-box{
        background: white;
        padding: 25px;
        border-radius: 20px;
    }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="title">Edit Student Result</h1>
        <p class="description">Edit student result information</p>
        <div class="result-box">
            <form method="POST">
                <div class="mb-3">
                    <label for="">Student_Name:</label>
                    <select name="student_id" class="form-control">
                        <?php foreach($students as $student):?> <!-- 一个一个显示学生 -->
                                            <!-- 保存学生的 ID -->
                            <option value="<?= $student['id'] ?>"
                             <?= $student['id'] == $result['student_id'] ? 'selected' : '' ?>>
                             <!-- 保自动选择原本的学生 -->
                            <?= $student['name'] ?> 
                            <!-- 显示学生的名字 -->
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Course_Name:</label>
                    <select name="course_id" class="form-control">
                        <?php foreach($courses as $course): ?>
                            <option value="<?= $course['id'] ?>"
                            <?= $course['id'] == $result['course_id'] ? 'selected' : '' ?>>
                            <?= $course['name'] ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Score:</label>
                    <input type="number" name="marks" value="<?= $result['marks'] ?>" class="form-control" placeholder="Please enter score">
                </div>                                       <!-- 显示原本的分数，可以修改 -->
                <div class="mb-3">
                    <label for="">Grade:</label>
                    <input type="text" name="grade" value="<?= $result['grade'] ?>" class="form-control" placeholder="Please enter score">
                </div>
                <button class="btn btn-outline-success" name="edit" type="submit">Edit Result</button>
                <a href="manage-result.php" class="btn btn-outline-danger">Back</a>
            </form>
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->