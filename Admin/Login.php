<?php
// Include config file
require_once '../config.php';

// Define variables and initialize with empty values
$username = $id = $email = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = 'رجاء ادخال سم المستخدم';
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = 'ادخل كلمة السر';
    } else {
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM Users WHERE username = :username";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $hashed_password = $row['password'];
//                        $password = "Hello";
//                        $hash = password_hash($password, PASSWORD_DEFAULT);
//                        echo $hash;
//                        var_dump(password_verify("Hello", $hash));
//                        $rr= $password. $hashed_password;

//                        echo $h;
                        if ($password == $hashed_password) {
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['id'] = $row['id'];
                            $_SESSION['email'] = $email;
                            header("location: ../Profiles/add.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = 'كلمة السر غير مطابقة';
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = 'لا يوجد حساب بهذا الاسم';
                }
            } else {
                echo "خطأ, حاول لاحقًا";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>
<?php include('../layout/header.html') ?>
<br>


<div class="container">
    <div class="wrapper">
        <div class="card" style="width: 50%; margin-left: 25%">
            <div class="card-body">
                <h2>دخول الأدارة</h2>
                <!--    <p>Please fill in your credentials to login.</p>-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label for="user">اسم المستخدم</label>
                        <input type="text" name="username" id="user" class="form-control"
                               value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <label for="pass">كلمة السر</label>
                        <input type="password" id="pass" name="password" class="form-control">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
<!--                    <p>ليس لديك حساب <a href="Signup.php">سجل حساب جديد</a>.</p>-->
                </form>
            </div>
        </div>
        <div class="card" style="
    margin-top: -31%;
    width: 21%;">
            <div class="card-img">
                <img src="../assets/img/sid.png">
            </div>
        </div>


        <div class="card" style="
    margin-top: -67%;
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

</div>
</div>

<?php include('../layout/footer.html') ?>
