<?php
include('../configM.php');

$sql = "SELECT * FROM `tickets`";
$result = $conn->query($sql);

?>


<?php include('layout/header.html') ?>

<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">الوجهة</th>
            <th scope="col">الزمن الرحلة</th>
            <th scope="col">يوم</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if ($result->num_rows > 0) {

            while ($row = mysqli_fetch_array($result)) { //loop over the result set
                // there are various ways to combine the names, this is one example
//                                        $name = $row['id'] . ' ' . $row['name'];
                $ID = $row['id'];
                $country = $row['country'];
                $time = $row['time'];
                $day_go = $row['day_go'];

                echo "<tr> ";
                echo "<td> $ID </td>";
                echo "<td> $country </td>";
                echo "<td> $time </td>";
                echo "<td> $day_go </td>";

                echo "</tr>";
            }
        }
        ?>

        </tbody>
    </table>

</div>
<?php include('layout/footer.html') ?>
