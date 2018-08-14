<?php
include('../configM.php');

$country = $name = $masseg = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $sql = "INSERT INTO `Airlines`(`id`, `name`, `country`)
VALUES ('', '$name', '$country');";

    if (mysqli_multi_query($conn, $sql)) {
        $masseg = "تم اضافة الخط";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>



<?php include('layout/header.html'); ?>

<br>


<div class="container">
    <div class="container">
        <div class="card-header">
            <h1>اضافة خط جديد</h1>

        </div>
        <h2 class="btn btn-block btn-success"><?php echo $masseg ?></h2>
        <div class="card" style="width: 50%; margin-left: 25%">
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="name">اسم الخط:</label><input type="text" class="form-control" id="name" name="name"
                                                                  value="<?php echo $name ?>">
                    </div>
                    <div class="form-group">
                        <label for="country">البلد التي تتبع للخط</label><input type="text" class="form-control"
                                                                                id="country" name="country"
                                                                                value="<?php echo $country ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ</button>
                </form>

            </div>
        </div>
        <div class="card" style="
    margin-top: -24%;
    width: 21%;">
            <div class="card-img">
                <img src="../assets/img/sid.png">
            </div>
        </div>


        <div class="card"style="
    margin-top: -67%;
    width: 21%;
    margin-left: 79%;
    "">
            <div class="card-img">
                <img src="../assets/img/sid.png">
            </div>
        </div>
    </div>
</div>
<?php include('layout/footer.html'); ?>

