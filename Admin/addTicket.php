<?php
include('../configM.php');
$masseg = $airline_id = $country = $time = $day_go = $day_come = $available = $price = $descount = $ticket_type = $item = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $airline_id = $_POST['airline_id'];
    $country = trim(strtolower($_POST['country']));
//    $time = trim($_POST['time']);
    $time = "00";
    echo "44w";
    $day_go = $_POST['day_go'];
    $day_come = $_POST['day_come'];
    $available = $_POST['available'];
    $price = $_POST['price'];
    $descount = $_POST['descount'];
    $ticket_type = trim($_POST['ticket_type']);

    $sql = "INSERT INTO `tickets` (`id`, `airline_id`, `country`, `time`, `day_go`, `day_come`, `available`, `price`, `descount`, `ticket_type`)  
VALUES ('' , $airline_id, $country, $time, $day_go, $day_come, $available, $price, $descount, $ticket_type);";

    if (mysqli_multi_query($conn, $sql)) {
        $masseg = "تم اضفة التذاكر بنجاح";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT * FROM `Airlines`";
    $result = $conn->query($sql);
//if ($result->num_rows > 0) {
// output data of each row


//    while ($row = $result->fetch_object()) {
//        $item = $row;
////        printf ("%s (%s)\n", $row["id"], $row["name"]);
////        $id = $row["id"];
////        $itemName = $row['name'];
//    }
//    while ($row = $result->fetch_assoc()) {
//        $names = [$row['name']];
//        $ids = [$row['id']];
//        foreach ($names as $itemName){
//        }foreach ($ids as $id){
//        }
//    }
//    }
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
                        <input type="time" name="time" id="time" class="form-control">
                    </div>

                    <div class="form-group">
                        <div class="form-row">

                            <div class="col-sm-6">
                                <input type="date" placeholder="الى يوم" name="day_go" width="90%"/>
                            </div>

                            <div class="col-sm-6">
                                <input type="date" placeholder="من يوم" name="day_come" width="90%"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="price">سعر التذكرة</label>
                        <input name="price" type="number" placeholder="السعر" id="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="available">المتاح</label>
                        <input name="available" type="number" placeholder="عدد التذاكر" id="available"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="descount"></label>
                        <input class="form-control" name="descount" type="number" placeholder="حقل اختياري"
                               id="descount">
                    </div>
                    <div class="form-group">
                        <label for="tt">اختار الخط:</label><select class="custom-select" data-live-search="true"
                                                                   name="ticket_type" id="tt">
                            <option value="Vip">رجال الاعمال</option>
                            <option value="Class">الدرجة الاولة</option>
                            <option value="Economic">الأقتصادية</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ</button>
                </form>

            </div>
        </div>
        <!--        <div class="card" style="-->
        <!--    margin-top: -24%;-->
        <!--    width: 21%;">-->
        <!--            <div class="card-img">-->
        <!--                <img src="../assets/img/sid.png">-->
        <!--            </div>-->
        <!--        </div>-->


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


