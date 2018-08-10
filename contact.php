<?php
include('configM.php');

$country = $name = $message = $phone = $email = $masseg = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['$email'];
    $message = $_POST['$message'];
    $phone = $_POST['phone'];
    $sql = "INSERT INTO `contact`(`id`, `name`, `Email`, `phone`, `message`)
VALUES ('', $name, $email, $phone, $message);";

    if (mysqli_multi_query($conn, $sql)) {
        $masseg = "تم ارسال الرسالة";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>


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

    <title>تاركو | الاتصال بنا</title>
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
                <a class="nav-link btn btn-block " href="Users/Login.php">تسجيل\ دخول <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item mr-auto">
                <a class="nav-link btn btn-block " href="#">الاتصال بنا <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item mr-auto">
                <a class="nav-link btn btn-block " href="Users/Wellcome.php">الحجوزات <span class="sr-only">(current)</span></a>
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


<div class="container">
    <div class="container">
        <div class="card-header">
            <h1>ارسال رسالة</h1>

        </div>
        <h2 class="btn btn-block btn-success"><?php echo $masseg ?></h2>
        <div class="card" style="width: 50%; margin-left: 25%">
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="name">الاسم الكامل:</label><input type="text" class="form-control" id="name"
                                                                      name="name">
                    </div>

                    <div class="form-group">
                        <label for="phone">رقم الهاتف</label><input type="tel" class="form-control"
                                                                    id="phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label for="email">البريد الالكتروني</label><input type="email" class="form-control"
                                                                           id="email" name="email">
                    </div>

                    <div class="form-group">
                        <label for="mss"> نص الرسالة</label>
                        <textarea class="form-control" name="message" id="mss"></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary">ارسال</button>
                </form>

            </div>
        </div>
        <div class="card" style="
    margin-top: -39%;
    width: 21%;">
            <div class="card-img">
                <img src="assets/img/sid.png">
            </div>
        </div>


        <div class="card" style="
    margin-top: -67%;
    width: 21%;
    margin-left: 79%;
    "
        ">
        <div class="card-img">
            <img src="assets/img/sid.png">
        </div>
    </div>
</div>
</div>

<footer></footer>
<script src="assets/js/jquery.min.js"></script>


<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<!--<script src="../assets/js/defaults-ar_AR.min.js"></script>-->

<script src="assets/js/bootstrap.min.js"></script>
<!--<script src="../assets/js/defaults-en_US.min.js"></script>-->

<script src="assets/js/gijgo.min.js"></script>
<!--<script src="../assets/js/jquery-ui.js"></script>-->

<script>
    $('#datepickerFrom').datepicker({
        uiLibrary: 'bootstrap4'
    });

    $(document).ready(function () {
        $('#datepickerTo').datepicker({
            uiLibrary: 'bootstrap4'
        });
    });
</script>


</body>
</html>
<?php include('layout/footer.html'); ?>

