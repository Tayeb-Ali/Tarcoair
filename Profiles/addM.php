<?php
//include('../configM.php');
session_start();

//if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nameD = $_SESSION['username'];

    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'flay';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$conn) {
        die('Could not connect: ' . mysqli_error());
    }
    echo 'Connected successfully<br>';
    echo $nameD. $nameD;

    $sql = "SELECT * FROM Users WHERE Username =:nameD ";
if ($stmt = $conn->prepare($sql)) {
    $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);

// Set parameters
    $param_username = $_SESSION['username'];;
}
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Name: " . $row["Email"] . "<br>";
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
//}
?>
