<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/gijgo.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.rtl.min.css">
    <!--<link rel="stylesheet" href="../assets/css/bootstrap-select.min.css">-->
    <!--<link rel="stylesheet" href="../assets/css/bootstrap-datepicker.min.css">-->

    <title>تاركو|Tarco</title>
</head>
<body style="background-color: #2e6da414">


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img class="navbar-brand" src="assets/img/logo.png"/>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link btn btn-block " href="Users/Login.php">تسجيل\ دخول <span
                            class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item mr-auto">
                <a class="nav-link btn btn-block " href="#">الاتصال بنا <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item mr-auto">
                <a class="nav-link btn btn-block " href="Users/Wellcome.php">الحجوزات <span
                            class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link btn btn-block " href="../">الرئيسية <span class="sr-only">(current)</span></a>
            </li>

        </ul>
        <img class="navbar-brand" src="assets/img/logo.png"/>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<br>


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/img/maxresdefault.jpg" width="480" height="350" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/bk2.jpg" width="480" height="350" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/img/bk1.jpeg" width="480" height="350" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="container">
    <br>
    <div style="text-align: center;">
        <?php session_start();

        // If session variable is not set it will redirect to login page
        if (isset($_SESSION['username'])) {
            header("location: Users/Wellcome.php");
            exit;
        }
        ?>

        <a href="Users/Login.php" class="btn btn-lg btn-secondary">تسجيل الدخول</a>
        <a href="Users/Signup.php" class="btn btn-lg btn-success">تسجيل جديد</a>
    </div>
</div>


<script src="assets/js/jquery.min.js"></script>


<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<!--<script src="../assets/js/defaults-ar_AR.min.js"></script>-->

<script src="assets/js/bootstrap.min.js"></script>
<!--<script src="../assets/js/defaults-en_US.min.js"></script>-->

<script src="assets/js/gijgo.min.js"></script>
<!--<script src="../assets/js/jquery-ui.js"></script>-->

</body>
</html>
<?php include('layout/footer.html'); ?>


