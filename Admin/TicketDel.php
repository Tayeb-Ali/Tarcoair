<?php
$id  ="";

$id = $_GET["id"];
include ('../configM.php');

$sql = "DELETE FROM tickets WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);