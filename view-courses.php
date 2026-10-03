<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$db = new PDO("mysql:host=localhost;dbname=student_management_system", "root", "");

                           // get data from courses
                           // teachers.name AS teacher_name = 获取老师的名字，并把它叫做 teacher_name
                           // get data from courses table
                           // 连接 teachers 表, 用 teacher_id to find the matching teachers
$statement = $db->prepare("SELECT courses.*,  
                            teachers.name AS teacher_name 
                            FROM courses
                            JOIN teachers ON courses.teacher_id = teachers.id
");
$statement->execute(); // run the SQL
$courses = $statement->fetchAll(PDO::FETCH_ASSOC); // get all data
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
        .courses-list{
            background: white;
            padding: 25px;
            border-radius: 20px;
        }
        .table thead th{
            background: #1e40af;
            color: white;
            padding: 10px;
        }
        .table tbody td{  
            padding: 15px;
             vertical-align: middle; /* make center */ 
        }
        .table tbody tr:hover td{ 
            background-color: #99d0e9; 
            color: white;
        }
    </style>
</head>
<body>
    <div class="container py-5"> <!-- py-5 : padding: 48px -->
        <h1 class="title">Courses List</h1>
        <p class="description">View courses information</p>

        <div class="courses-list">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Courses List</h4>
                <div>
                    <a href="users.php" class="btn btn-outline-danger">Back</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course_name</th>
                        <th>Description</th>
                        <th>Teacher_Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($courses as $course): ?> <!-- 一个一个显示老师 -->
                        <tr>
                            <td><?= $course['id']?></td>
                            <td><?= $course['name']?></td> <!-- show the course name -->
                            <td><?= $course['description']?></td>
                            <td><?= $course['teacher_name']?></td>
                        </tr>
                        <?php endforeach; ?> <!-- foreach loop  -->
                </tbody>
            </table> 
        </div>
    </div>
</body>
</html>
<!-- <p></p> -->