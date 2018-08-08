<?php
// Include config file
require_once '../config.php';

// Define variables and initialize with empty values
$username = $password = "";
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
        $sql = "SELECT username, password FROM Users WHERE username = :username";

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
                            header("location: Wellcome.php");
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>تسجيل دخول</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            /*width: 350px;*/
            /*padding: 20px;*/
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg  navbar-dark bg-primary">
    <a class="navbar-brand" href="#">
        <h2>Tarcko</h2>
    </a>
    <!--<nav class="navbar navbar-expand-lg bg-dark">-->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#">Link 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Link 3</a>
        </li>
    </ul>
</nav>
<br>


<div class="container">
<div class="wrapper">
    <div class="card">
        <div class="card-body">
    <h2>دخول المستخدم</h2>
    <!--    <p>Please fill in your credentials to login.</p>-->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>اسم المستخدم</label>
            <label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
            </label>
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>كلمة السر</label>
            <label>
                <input type="password" name="password" class="form-control">
            </label>
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>ليس لديك حساب <a href="Signup.php">سجل حساب جديد</a>.</p>
    </form>
</div>
</body>
</html>