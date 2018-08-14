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
<div class="container">
<?php
include("../config.php");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $ticket_id = $_GET["id"];
    $sql = "select airline_id,time,day_go,day_come from tickets where id =:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":id", $ticket_id, PDO::PARAM_STR);//$to,$country,$price
    if ($stmt->execute()) {
        $row = $stmt->fetch();
        $airline_id = $row["airline_id"];
        $time = $row["time"];
        $day_go = $row["day_go"];
        $day_come = $row["day_come"];
        ?>
        <div class="container" style="margin-top : 30px;">
            <!--    <div class="card">-->
            <!--        <div class="card-body">-->
            <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="form-row">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>"/>
                <input type="hidden" name="airline_id" value="<?php echo $airline_id; ?>">
                <input type="hidden" name="time" value="<?php echo $time; ?>">
                <input type="hidden" name="day_go" value="<?php echo $day_go; ?>">
                <input type="hidden" name="day_come" value="<?php echo $day_come; ?>">
                <div class="col-md-6 card" dir="rtl">
                    <div class="form-inline card-body">
                        <label class="text-center col-md-2" >نوع التذكرة</label>
                    <select name="ticket_type" class="form-control col-md-4" id="tick">
                        <option value="VIP">VIP</option>
                        <option value="Class">Class</option>
                        <option value="Economic">Economic</option>
                    </select>

                    </div>



                <input type="submit" class="col-md-offset-8 col-md-4 btn btn-primary" value="حجز"/>
                </div>
            </form>
        </div>
        <?php
    }
}
 else if ($_SERVER['REQUEST_METHOD'] == 'POST'){
     $ticket_id = $_POST["ticket_id"];
     $airline_id = $_POST["airline_id"];
     $user_id = $_SESSION['id'];
     $time = $_POST["time"];
     $day_go = $_POST["day_go"];
     $day_come = $_POST["day_come"];
     $ticket_type = $_POST["ticket_type"];
     $sql = "INSERT INTO bookings (ticket_id,airline_id,user_id,time,day_go,day_come,ticket_type) VALUES (:ticket_id,:airline_id,:user_id,:time,:day_go,:day_come,:ticket_type)";
     $stmt = $conn->prepare($sql);
     $stmt->bindParam(":ticket_id",$ticket_id,PDO::PARAM_INT);
     $stmt->bindParam(":airline_id",$airline_id,PDO::PARAM_INT);
     $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
     $stmt->bindParam(":time",$time,PDO::PARAM_STR);
     $stmt->bindParam(":day_go",$day_go,PDO::PARAM_STR);
     $stmt->bindParam(":day_come",$day_come,PDO::PARAM_STR);
     $stmt->bindParam(":ticket_type",$ticket_type,PDO::PARAM_STR);
     if ($stmt->execute()) {
         $sql = "select available from tickets where id=:id";
         $stmt = $conn->prepare($sql);
         $stmt->bindParam(":id",$ticket_id,PDO::PARAM_INT);
         if ($stmt->execute()){
             $row = $stmt->fetch();
             $available = $row["available"];
             $available = $available -1;
             $sql = "update tickets set available =:available  where id=:id";
             $stmt = $conn->prepare($sql);
             $stmt->bindParam(":id",$ticket_id,PDO::PARAM_INT);
             $stmt->bindParam(":available",$available,PDO::PARAM_INT);
             if ($stmt->execute()){
                 ?>
                 <div class="alert alert-success">تم الحجز بنجاح</div>
                 <?php
             }
             else{
                 ?>
                 <div class="alert alert-danger">error in update tickets available</div>
                 <?php
             }
         }
         else{
             ?>
             <div class="alert alert-danger">error in select tickets available</div>
             <?php
         }
     } else {
         ?>
         <div class="alert alert-danger">error in insert booking available</div>
         <?php

     }
}
    ?>
</div>
<?php include('../layout/footer.html'); ?>