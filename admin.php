<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
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
            color: blue;
            font-weight: bold;
        }
        .description{
            color: lightgray;
        }
        .hero{
            background: linear-gradient(135deg, #7e14e8, #5b48b0);
            border-radius: 20px;
            padding: 40px;
        }
        .icon{
            font-size: 45px;
        }
        .logout{
            border-radius: 10px;
            width: 200px;
        }
        .welcome{
            color: white;
        }
        .welcome-text{
            color: #dbeafe;
        }
        .card{
            border: none;
            border-radius: 18px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center">
            <h1 class="title">Student Management System</h1>
            <p class="description">Admin Dashboard</p>
        </div>

        <div class="hero mb-5">
            <h1 class="welcome">Welcome Back, <?php echo $_SESSION['user']['username'] ?>👋</h1>
            <p class="welcome-text mb-0">Manage student, teacher, courses and result.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">👨‍🎓</div>
                    <h4>Students</h4>
                    <p>Manage students</p> 
                    <a href="manage-student.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Students</a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">👨‍🏫</div>
                    <h4>Teachers</h4>
                    <p>Manage teachers</p> 
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Teachers </a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">📚</div>
                    <h4>Courses</h4>
                    <p>Manage Courses</p> 
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Courses</a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">📊</div>
                    <h4>Results</h4>
                    <p>Manage Results</p> 
                    <a href="" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Results</a>  
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="logout.php" class="btn btn-outline-danger logout"><i class="bi bi-box-arrow-in-right"></i> Logout</a>
        </div>
    </div>
</body>
</html>