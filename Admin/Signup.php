<?php
// Include config file
require_once '../config.php';

// Define variables and initialize with empty values
$username = $password = $FullName = $confirm_password = "";
$email = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "ادخل اسم المستخدم.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM Admin WHERE Username = :username";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $username_err = " اسم المستخدم موجود.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "خطاء عاود في وقت لاحق.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "ادخل البريدالالكتروني.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM Admin WHERE Email = :email";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = "البريد الالكتروني موجود.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "خطاء عاود في وقت لاحق.";
            }
        }

        // Close statement
        unset($stmt);
    }
    // Validate FullName
    if (empty(trim($_POST["FullName"]))) {
        $email_err = "FullName.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM Admin WHERE FullName = :FullName";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':FullName', $param_FullName, PDO::PARAM_STR);

            // Set parameters
            $param_FullName = trim($_POST["FullName"]);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $email_err = " موجود.";
                } else {
                    $email = trim($_POST["FullName"]);
                }
            } else {
                echo "خطاء عاود في وقت لاحق.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Validate password
    if (empty(trim($_POST['password']))) {
        $password_err = "ادخل كلمة السر.";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $password_err = "يجب ان لا تقل كلمة السر عن 6 حروف او ارقام.";
    } else {
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = 'اكد كلمة السر';
    } else {
        $confirm_password = trim($_POST['confirm_password']);
        if ($password != $confirm_password) {
            $confirm_password_err = 'كلمة السر غير متطابقا.';
        }
    }

    // Check input errors before inserting in database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO Admin ( FullName, username, Email, password) VALUES (:FullName, :username, :email, :password)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(':FullName', $param_FullName, PDO::PARAM_STR);
            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $param_email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);

            // Set parameters
            $param_username = $username;
            $param_emaile = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: Login.php");
            } else {
                echo "خطأ, حاول لاحقًا";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($conn);
}
?>

<?php include('../layout/header.html'); ?>
<br>

<div class="container">
    <div class="wrapper">
        <div class="card">
            <div class="card-body">
                <h2> اضافة موظف</h2>
                <!--                <p>Please fill this form to create an account.</p>-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                    <div class="form-group">
                        <label>الاسم
                            <input type="text" name="FullName" class="form-control">
                        </label>
                    </div>

                    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <label>البريد الالكتروني
                            <input type="text" name="email" class="form-control" value="<?php echo $email_err; ?>">
                        </label>
                        <span class="help-block"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>اسم المستخدم
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        </label>
                        <span class="help-block"><?php echo $username_err; ?></span>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>كلمة السر
                                <input type="password" name="password" class="form-control"
                                       value="<?php echo $password; ?>">
                            </label>
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                            <label>تأكيد كلمة السر
                                <input type="password" name="confirm_password" class="form-control"
                                       value="<?php echo $confirm_password; ?>">
                            </label>
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="تسجيل">
                            <input type="reset" class="btn btn-default" value="تفريغ الحقول">
                        </div>

                        <p>هل لديك حساب<a href="Login.php">تسجيل الدخول من هنا!</a>.</p>

                </form>
            </div>
        </div>
    </div>
</div>
<?php include('../layout/footer.html') ?>
