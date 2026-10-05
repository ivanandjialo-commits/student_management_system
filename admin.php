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
            background-color: #f1f5f9;
            font-family: Arial, sans-serif;
        }
        .container{
            max-width: 1150px;
        }
        .title{
            color: #1e3a8a;
            font-weight: bold;
            font-size: 36px;
            margin-bottom: 8px;
        }
        .description{
            color: #64748b;
            margin-bottom: 30px;
        }
        .hero{
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px ;
        }
        .icon{
            font-size: 45px;
            margin-bottom: 10px;
        }
        .logout{
            border-radius: 10px;
            padding: 10px;
            width: 200px;
        }
        .welcome{
            color: white;
            font-weight: bold;
        }
        .welcome-text{
            color: #dbeafe;
        }
        .card{
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 20px;
            height: 100%;
            transition: 0.2s;
        }
        .card:hover{
            transform: translateY(-5px);
            border-color: #93c5fd;
        }
        .card h4{
            color: #1e293b;
            font-weight: bold;
        }
        .card p{
            color: #64748b;
            margin-bottom: 20px;
        }
        .card .btn{
            background: #2563eb;
            border: none;
            border-radius: 10px;
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
                    <a href="manage-teacher.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Teachers </a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">📚</div>
                    <h4>Courses</h4>
                    <p>Manage Courses</p> 
                    <a href="manage-courses.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Courses</a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">📊</div>
                    <h4>Results</h4>
                    <p>Manage Results</p> 
                    <a href="manage-result.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Results</a>  
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="logout.php" class="btn btn-outline-danger logout"><i class="bi bi-box-arrow-in-right"></i> Logout</a>
        </div>
    </div>
</body>
</html>