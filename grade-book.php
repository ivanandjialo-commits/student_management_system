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
    <style>
        body{
            background-color: #f1f5f9;
        }
        .grade-card{
            border: none;
            border-radius: 20px;
            padding: 30px;
        }
        h1{
            color: #1e3a8a;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .list-group-item {
            padding: 15px;
            font-size: 18px;
            border: none;
            border-bottom: 1px solid #e5e7eb;
        }
        .grade {
            font-weight: bold;
            color: #2563eb;
        }
        .back-btn{
            padding: 10px 30px;
            background-color: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: bold;
        }
        .back-btn:hover{
            background-color: #2563eb;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-center align-items-center" style="height: 650px">
            <div class="col-md-6">
                <div class="card grade-card ">
                    <h1 class="text-center">Grade book</h1>
                    <div class="list-group">
                        <div class="list-group-item">
                            <span class="grade">A</span> : 95 - 100
                        </div>
                        <div class="list-group-item">
                            <span class="grade">A-</span> : 90 - 94-99
                        </div>
                        <div class="list-group-item">
                            <span class="grade">B+</span> : 85.00 - 89.99
                        </div>
                        <div class="list-group-item">
                            <span class="grade">B</span>  : 80 - 84-99
                        </div>
                        <div class="list-group-item">
                            <span class="grade">B-</span> : 75 - 79.99
                        </div>
                        <div class="list-group-item">
                            <span class="grade">C+</span> : 70 - 74.99
                        </div>
                        <div class="list-group-item">
                            <span class="grade">C</span>  : 60 - 69.99
                        </div>
                        <div class="list-group-item">
                            <span class="grade">F</span>  : 0 - 59.99
                        </div>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <a href="manage-result.php" class="back-btn">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>