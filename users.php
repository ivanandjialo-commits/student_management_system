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
        background: #faf5ff;
        font-family: Arial, sans-serif;
    }

    .title{
        color: #7e22ce;
        font-weight: bold;
        font-size: 36px;
        margin-bottom: 8px;
    }

    .description{
        color: #64748b;
        margin-bottom: 30px;
    }

    .hero{
        background: #7e22ce;
        border-radius: 20px;
        padding: 35px;
        margin-bottom: 30px;
    }

    .welcome{
        color: white;
        font-weight: bold;
    }

    .welcome-text{
        color: #f3e8ff;
    }

    .card{
        background: white;
        border: 1px solid #e9d5ff;
        border-radius: 15px;
        padding: 20px;
        height: 100%;
        transition: 0.2s;
    }

    .card:hover{
        border-color: #a855f7;
    }

    .icon{
        font-size: 40px;
        margin-bottom: 10px;
    }

    .card h4{
        color: #581c87;
        font-weight: bold;
    }

    .card p{
        color: #64748b;
        margin-bottom: 20px;
    }

    .card .btn{
        background: #9333ea;
        border: none;
        border-radius: 8px;
    }

    .card .btn:hover{
        background: #7e22ce;
    }
    .profile{
        position: absolute;
        top: 25px;
        right: 60px;
    }
    .profile .btn{
        background: white;
        color: #1e3a8a;
        border: 1px solid #dbeafe;
        border-radius: 12px;
        padding: 10px 15px;
    }
    .profile .dropdown-item:hover{
        background: #eff6ff;
    }
</style>
</head>
<body>
    <div class="profile dropdown">
        <button class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle"></i>
            <?php echo $_SESSION['user']['username']; ?>
        </button>
        <ul class="dropdown-menu">
            <li><a href="profile.php" class="dropdown-item">
                <i class="bi bi-person me-2"></i>My Profile</a>
            </li>
            <li><a href="logout.php" class="dropdown-item">
                <i class="bi bi-box-arrow-right me-2"></i>Logout</a>
            </li>
        </ul>
    </div>
    <div class="container py-5">
        <div class="text-center">
            <h1 class="title">Student Management System</h1>
            <p class="description">Users Dashboard</p>
        </div>

        <div class="hero mb-5">
            <h1 class="welcome">Welcome Back, <?php echo $_SESSION['user']['username'] ?>👋</h1>
            <p class="welcome-text mb-0">View student, teacher, courses and result.</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">👨‍🎓</div>
                    <h4>Students</h4>
                    <p>View students</p> 
                    <a href="view-student.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> View Students</a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">👨‍🏫</div>
                    <h4>Teachers</h4>
                    <p>View teachers</p> 
                    <a href="view-teachers.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> View Teachers</a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">📚</div>
                    <h4>Courses</h4>
                    <p>View Courses</p> 
                    <a href="view-courses.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> Manage Courses</a>  
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card text-center p-4">
                    <div class="icon">📊</div>
                    <h4>Results</h4>
                    <p>View Results</p> 
                    <a href="view-result.php" class="btn btn-primary w-100"><i class="bi bi-arrow-right"></i> View Results</a>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>