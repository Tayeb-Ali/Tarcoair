<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
?>


<?php include('../layout/header.html'); ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="../assets/img/maxresdefault.jpg" width="480" height="350" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="../assets/img/bk2.jpg" width="480" height="350"  alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="../assets/img/bk1.jpeg" width="480" height="350"  alt="Third slide">
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



<div class="container" style="margin-top : 30px;">
<!--    <div class="card">-->
<!--        <div class="card-body">-->
            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="form-row">

                <div class="col-md-3">
                    <input type="date" id="datepickerTo" placeholder="To" name="to" width="276"/>

                </div>

                <div class="col-md-3">
                    <input type="date" id="datepickerFrom" placeholder="From" name="from" width="276"/>
                </div>
            

                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="Country" id="country" name="country">
                </div>

                <div class="col-md-3">
                    <input type="number" class="form-control" placeholder="price" id="price" name="price">
                </div>
                <br>
            
                    <input type="submit" style="margin-left: 40%;" class="col-md-offset-8 col-md-2 btn btn-primary" value="إستعلام" />
                
            </form>
        </div>
<!--    </div>-->
<!--</div>-->
<?php
include ("../config.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $sq = "select t.id, a.name as name, a.country as country_from, t.country as country_to , t.time as time, t.day_go as start_date, t.day_come as end_date, t.price as price, t.descount as discount, t.available as available, t.ticket_type as type from tickets t join Airlines a on t.airline_id = a.id";
    $stmt=$conn->prepare($sq);
    if ($stmt->execute()){?>
        <div class="container">
            <table class="table table-border">
                <thead>
                <td>الطيران</td>
                <td>من</td>
                <td>إلي</td>
                <td>زمن الإقلاع</td>
                <td>تاريخ بداية الرحله</td>
                <td>تاريخ إنتهاء الرحلة</td>
                <td>السعر</td>
                <td>التخفيض</td>
                <td>نوع التذكرة</td>
                <td>المتاح</td>
                <td></td>
                </thead>
                <tbody>
                <?php
                while ($row =$stmt->fetch()){?>z
                    <tr>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["country_from"]; ?></td>
                        <td><?php echo $row["country_to"]; ?></td>
                        <td><?php echo $row["time"]; ?></td>
                        <td><?php echo $row["start_date"]; ?></td>
                        <td><?php echo $row["end_date"]; ?></td>
                        <td><?php echo $row["price"]; ?></td>
                        <td><?php echo $row["discount"]; ?></td>
                        <td><?php echo $row["type"]; ?></td>
                        <td><?php echo $row["available"]; ?></td>
                        <td><a class="btn btn-primary" href="booking.php?id=<?php echo $row["id"]; ?>" > حجز</a></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

            <?php
            if ($stmt->rowCount() == 0){
                ?>
                <div class="alert alert-success">
                    No Flieght With This Info
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $to = $_POST["to"];    
    $from = $_POST["from"];
    $country = $_POST["country"];
    $price = $_POST["price"];//price
    $sq = "select t.id, a.name as name, a.country as country_from, t.country as country_to , t.time as time, t.day_go as start_date, t.day_come as end_date, t.price as price, t.descount as discount, t.ticket_type as type from tickets t join airlines a on t.airline_id = a.id where t.day_go = :from or t.day_come = :to or t.country = :country or t.price = :price";

    $sql = "SELECT a.name as name, a.country  , t.time as time, t.day_go as start_date, t.day_come as end_date, t.price as price, t.descount as discount, t.ticket_type as type"
    . "  from tickets t join airlines a on t.airline_id = a.id".
    "    where t.day_go = :from and t.day_come = :to and t.country = :country and t.price = :price";
    $stmt=$conn->prepare($sq);
    $stmt->bindParam(":from",$from,PDO::PARAM_STR);//$to,$country,$price
    $stmt->bindParam(":to",$to,PDO::PARAM_STR);//$to,$country,$price
    $stmt->bindParam(":country",$country,PDO::PARAM_STR);//$to,$country,$price
    $stmt->bindParam(":price",$price,PDO::PARAM_STR);//$to,$country,$price
    
    if ($stmt->execute()){?>
    <div class="container">
        <table class="table table-border">
            <thead>
                <td>Airline Name</td>
                <td>Country From</td>
                <td>Country To</td>
                <td>Time</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Price</td>                
                <td>Discount</td>
                <td>Type</td>
                <td></td>
            </thead>        
            <tbody>       
        <?php
        while ($row =$stmt->fetch()){?>
                <tr>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["country_from"]; ?></td>
                    <td><?php echo $row["country_to"]; ?></td>
                    <td><?php echo $row["time"]; ?></td>
                    <td><?php echo $row["start_date"]; ?></td>
                    <td><?php echo $row["end_date"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td><?php echo $row["discount"]; ?></td>
                    <td><?php echo $row["type"]; ?></td>                                                                                               
                    <td><a class="btn btn-primary" href="booking.php?id=<?php echo $row["id"]; ?>" > حجز</a></td>
                </tr>
        <?php 
        }
        ?>
                </tbody>
            </table>
        
        <?php
        if ($stmt->rowCount() == 0){
         ?>
        <div class="alert alert-success">
            No Flieght With This Info
        </div>
        <?php   
        }
    ?>  
        </div>
    <?php
    } 
} ?>


<?php include('../layout/footer.html'); ?>
