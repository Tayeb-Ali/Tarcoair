<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
?>


<?php include('layout/header.html'); ?>

<div class="container">
<!--    <div class="card">-->
<!--        <div class="card-body">-->
            <div class="form-row">

                <div class="col-md-3">
                    <input id="datepickerTo" placeholder="To" name="to" width="276"/>

                </div>

                <div class="col-md-3">
                    <input id="datepickerFrom" placeholder="From" name="from" width="276"/>
                </div>
            </div>

            <div class="col-md-3">
                <input class="inpu">
            </div>

        </div>
<!--    </div>-->
<!--</div>-->


<?php include('layout/footer.html'); ?>
