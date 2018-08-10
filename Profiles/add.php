<?php

session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: ../Users/login.php");
    exit;
}
$user_id = $_SESSION['id'];


require_once '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FullName = $PassportNumber = $PassportExt = $PassportEnd = $Nationality = $BirthDay = $Job = "";

    $FullName = $_POST["FullName"];
    $PassportNumber = $_POST["PassportNumber"];
    $PassportExt = $_POST["PassportExt"];
    $PassportEnd = $_POST["PassportEnd"];
    $Nationality = $_POST["Nationality"];
    $Job = $_POST["Job"];
    $BirthDay = $_POST["BirthDay"];

    $FullName_err = $PassportNumber_err = $PassportExt_err = $PassportEnd_err = $Nationality_err = $BirthDay_err = $Job_err = "";

    $user_id = $_SESSION['id'];

// Processing form data when form is submitted
    $sql = "INSERT INTO `Profile` 
(`id`, `user_id`, `FullName`, `PassportNumber`, `PassportExt`, `PassportEnd`, `Nationality`, `BirthDay`, `Job`) 
VALUES (NULL,$user_id, :FullName, :PassportNumber, :PassportExt, :PassportEnd, :Nationality, :BirthDay, :Job)";
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
//        $stmt->bindParam(':user_id', $param_user_id, PDO::PARAM_STR);
        $stmt->bindParam(':FullName', $param_FullName, PDO::PARAM_STR);
        $stmt->bindParam(':PassportNumber', $param_PassportNumber, PDO::PARAM_STR);
        $stmt->bindParam(':PassportExt', $param_PassportExt, PDO::PARAM_STR);
        $stmt->bindParam(':PassportEnd', $param_PassportEnd, PDO::PARAM_STR);
        $stmt->bindParam(':Nationality', $param_Nationality, PDO::PARAM_STR);
        $stmt->bindParam(':BirthDay', $param_BirthDay, PDO::PARAM_STR);
        $stmt->bindParam(':Job', $param_Job, PDO::PARAM_STR);


        // Set parameters
//        $param_user_id = $user_id;
        $param_FullName = $FullName;
        $param_PassportNumber = $PassportNumber;
        $param_PassportExt = $PassportExt;
        $param_PassportEnd = $PassportEnd;
        $param_Nationality = $Nationality;
        $param_BirthDay = $BirthDay;
        $param_Job = $Job;


        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to login page
//            header("location: Login.php");
        } else {
            echo "خطأ, حاول لاحقًا";
        }

// Close statement
        unset($stmt);


// Close connection
        unset($conn);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $FullName = $PassportNumber = $PassportExt = $PassportEnd = $Nationality = $BirthDay = $Job = "";
    $FullName_err = $PassportNumber_err = $PassportExt_err = $PassportEnd_err = $Nationality_err = $BirthDay_err = $Job_err = "";
    $user_id = $_SESSION['id'];

    $conn = new mysqli('localhost', 'root', '', 'flay');
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `Profile` WHERE user_id =9";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
//          $res = [
//              $FullName = $row['FullName'],
//            $PassportNumber = $row['PassportNumber'],
//            $PassportExt = $row['PassportExt'],
//            $PassportEnd = $row['PassportEnd'],
//            $Nationality = $row['Nationality'],
//            $BirthDay = $row['BirthDay'],
//            $Job = $row['Job'],
//          ];
//          foreach ($res as $re){
//              echo $re;
//          }
            $FullName = $row['FullName'];
            $PassportNumber = $row['PassportNumber'];
            $PassportExt = $row['PassportExt'];
            $PassportEnd = $row['PassportEnd'];
            $Nationality = $row['Nationality'];
            $BirthDay = $row['BirthDay'];
            $Job = $row['Job'];
        }
    } else {
        echo "0 results";
    }


}
?>

<?php include('../layout/header.html'); ?>
    <!--<h2>--><?php //echo $_SESSION['username'];
?><!--</h2>-->
    <!--<h2>--><?php //echo $_SESSION['id'];
?><!--</h2>-->
    <!--<h2>--><?php //echo $_SESSION['email'];
?><!--</h2>-->

    <div class="container">
        <br>
        <div class="container">
            <div class="card" style="margin-left: 20%; width: 50%">
                <div class="card-body">
                    <h2> الملف الشخصي</h2>
                    <!--                <p>Please fill this form to create an account.</p>-->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group <?php echo (!empty($FullName_err)) ? 'has-error' : ''; ?>">
                            <label>اسم الكامل
                                <input type="text" name="FullName" value="<?php echo $FullName ?>" class="form-control">
                            </label>
                        </div>

                        <div class="form-group <?php echo (!empty($PassportNumber_err)) ? 'has-error' : ''; ?>">
                            <label>رقم الجواز
                                <input type="number" name="PassportNumber" class="form-control"
                                       value="<?php echo $PassportNumber; ?>">
                            </label>
                        </div>

                        <div class="form-group <?php echo (!empty($PassportExt_err)) ? 'has-error' : ''; ?>">
                            <label>تأريخ الإصدار
                                <input type="date" name="PassportExt" class="form-control"
                                       value="<?php echo $PassportExt; ?>">
                            </label>
                        </div>
                        <div class="form-group <?php echo $PassportEnd_err ? 'has-error' : ''; ?>">
                            <label>تأريخ الإنتهاء
                                <input type="date" name="PassportEnd" class="form-control"
                                       value="<?php echo $PassportEnd; ?>">
                            </label>
                        </div>

                        <div class="form-group <?php echo (!empty($Nationality_err)) ? 'has-error' : ''; ?>">
                            <label> الجنسية
                                <input type="text" name="Nationality" class="form-control"
                                       value="<?php echo $Nationality ?>">
                            </label>
                        </div>

                        <div class="form-group <?php echo (!empty($BirthDay_err)) ? 'has-error' : ''; ?>">
                            <label>تاريخ الميلاد
                                <input type="date" name="BirthDay" class="form-control"
                                       value="<?php echo $BirthDay ?>">
                            </label>
                        </div>

                        <div class="form-group <?php echo (!empty($Job_err)) ? 'has-error' : ''; ?>">
                            <label>الوظيفة
                                <input type="text" name="Job" class="form-control"
                                       value="<?php echo $Job ?>">
                            </label>
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <input type="reset" class="btn btn-default" value="Reset">
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include('../layout/footer.html'); ?>