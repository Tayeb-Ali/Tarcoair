<?php
include('../configM.php');

$sql = "SELECT * FROM `Admin`";
$result = $conn->query($sql);

?>


<?php include('layout/header.html') ?>

<div class="container">
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">اسم المستخدم</th>
            <th scope="col">البريد الالكتروني</th>
            <th>تعديل\حذف</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if ($result->num_rows > 0) {

            while ($row = mysqli_fetch_array($result)) { //loop over the result set
                // there are various ways to combine the names, this is one example
//                                        $name = $row['id'] . ' ' . $row['name'];
                $ID = $row['id'];
                $FullName = $row['FullName'];
                $PassportNumber = $row['Username'];
                $Nationality = $row['Email'];

                echo "<tr> ";
                echo "<td> $ID </td>";
                echo "<td> $FullName </td>";
                echo "<td> $PassportNumber </td>";
                echo "<td> $Nationality </td>";
                ?>
                <td><a class="btn btn-primary">تعديل</a>
                    <a class="btn btn-danger">حذف</a></td>
                <?php
                echo "</tr>";
            }
        }
        ?>

        </tbody>
    </table>

</div>
<?php include('layout/footer.html') ?>
