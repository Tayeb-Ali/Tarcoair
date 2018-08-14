<?php
include('../layout/header.html');
?>


    <div class="container">
        <div style="
margin-left: 30%;
width: 50%;
" class="card">
            <div class="card-body">
                <form action="Signup.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputPassword1">اسم المستخدم</label>
                        <input type="text" class="form-control" id="exampleInputUsername" placeholder="اسم المستخدم " name="username">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">البريد الألكتروني</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="ادخل الابريد الالكتروني" name="email">
                        <small id="emailHelp" class="form-text text-muted">
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">كلمة السر</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة السر" name="password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>


                    <button type="submit" class="btn btn-primary">تسجيل</button>
                </form>
            </div>
        </div>
    </div>
<!--<div class="container">-->
<!--    <div class="card">-->
<!--        <div class="card-body">-->
<!---->
<!--            <form>-->
<!--                -->
<!--            </form>-->
<!---->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

<?php
include('../layout/footer.html');
?>