<?php
include('../configM.php');
$masseg = $TiId = $airline_id = $country = $time = $day_go = $day_come = $available = $price = $descount = $ticket_type = $item = "";
$TiId = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $airline_id = $_POST['airline_id'];
    $country = trim(strtolower($_POST['country']));
//    $time = trim($_POST['time']);
    $time = $_POST["time"];
    $day_go = $_POST['day_go'];
    $day_come = $_POST['day_come'];
    $available = $_POST['available'];
    $price = $_POST['price'];
    $descount = $_POST['descount'];
    $ticket_type = trim($_POST['ticket_type']);

    $sql = "UPDATE `tickets` set (`airline_id`, `country`, `time`, `day_go`, `day_come`, `available`, `price`, `descount`, `ticket_type`)  
VALUES ($airline_id, '$country', '$time', '$day_go', '$day_come', $available, $price, $descount, '$ticket_type')
WHERE id=$TiId;";

    if (mysqli_multi_query($conn, $sql)) {
        $masseg = "تم اضفة التذاكر بنجاح";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM `tickets` WHERE id =$TiId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
// output data of each row

        while ($row = $result->fetch_assoc()) {
            $airline_id = $row['airline_id'];
            $country = $row['country'];
            $time = $row['time'];
            $day_go = $row['day_go'];
            $day_come = $row['day_come'];
            $available = $row['available'];
            $price = $row['price'];
            $descount = $row['descount'];
            $ticket_type = $row['ticket_type'];

        }
    }
}

?>



<?php include('layout/header.html'); ?>

<br>


<div class="container">
    <div class="container">
        <div class="card-header">
            <h1>اضافة تذاكر</h1>

        </div>
        <h2 class="btn btn-block btn-success"><?php echo $masseg ?></h2>
        <div class="card" style="width: 50%; margin-left: 25%">
            <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                    <div class="form-group">
                        <label> اختار الخط:</label>
                        <label>
                            <select class="custom-select" data-live-search="true" name="airline_id">
                                <?php
                                $sql = "SELECT * FROM `Airlines`";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {

                                    while ($row = mysqli_fetch_array($result)) { //loop over the result set
                                        // there are various ways to combine the names, this is one example
//                                        $name = $row['id'] . ' ' . $row['name'];
                                        $name = $row['name'];
                                        echo "<option value=" . $row['id'] . " >$name</option>";
                                    }
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="country">البلد</label><input type="text" class="form-control"
                                                                 id="country" name="country"
                                                                 value="<?php echo $country ?>">
                    </div>

                    <div class="form-group">
                        <label for="time">زمن الرحلة</label>
                        <input type="time" name="time" id="time" value="<?php echo $time ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="form-row">

                            <div class="col-sm-6">
                                <input type="date" placeholder="الى يوم" name="day_go" value="<?php echo $day_go ?> "width="90%"/>
                            </div>

                            <div class="col-sm-6">
                                <input type="date" placeholder="من يوم" value="<?php echo $day_come ?>" name="day_come" width="90%"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price">سعر التذكرة</label>
                        <input name="price" type="number" placeholder="السعر" value="<?php echo $price ?>" id="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="available">المتاح</label>
                        <input name="available" type="number" placeholder="عدد التذاكر" value="<?php echo $available ?>" id="available"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descount">الخصم</label>
                        <input class="form-control" name="descount" type="number"value="<?php echo $descount ?>" placeholder="حقل اختياري"
                               id="descount">
                    </div>
                    <div class="form-group">
                        <label for="tt">اختار الخط:</label><select class="custom-select" data-live-search="true"
                                                                   name="ticket_type"  id="tt">
                            <option value="Vip">رجال الاعمال</option>
                            <option value="Class">الدرجة الاولة</option>
                            <option value="Economic">الأقتصادية</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ</button>
                </form>

            </div>
        </div>

        <div class="card" style="
    margin-top: -57%;
    width: 21%;
    margin-left: 79%;
    "
        ">
        <div class="card-img">
            <img src="../assets/img/sid.png">
        </div>
    </div>
</div>
</div>
<?php include('layout/footer.html'); ?>


