<?php require_once('common/locations/views/currentLocation.php'); ?>
<div class="row">

    <div class="row">
        <form action="./homepage/login/models/login.php" method="post" role="form" class="contactForm lead">
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <label style="font-size:12px;">Username/Email</label>
                <input type="text" name="Uname" class="form-control input-sm" required />
            </div>
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <label style="font-size:12px;">Password</label>
                <input type="password" name="password" class="form-control input-sm" required />
            </div>
            <div class="col-sm-3 col-sm-3 col-sm-3">
                <label style="font-size:12px;">&nbsp;</label>
                <button style="font-size:12px;" type="submit" value="login" class="btn btn-skin btn-block btn-sm">Login</button>
            </div>
    </div>
    <div class="row">
        <div class="col-sm-4 col-sm-4 col-sm-4">
            <?php if (isset($_SESSION['error_user']) || isset($_GET['notify'])) {
                if (isset($_SESSION['error_user'])) {
                    $error_user = $_SESSION['error_user'];
                    echo '<a style="color:red;font-size:14px;">' . $error_user . '</a>';
                    unset($_SESSION['error_user']);
                }
                if (isset($_GET['success_user'])) {
                    $notify = $_GET['notify'];
                    echo '<a style="color:red;font-size:14px;">' . $notify . '</a>';
                }
            }

            if (isset($_SESSION['success_user']) || isset($_SESSION['success_signup'])) {
                if (isset($_SESSION['success_user'])) {
                    $login_feedback = $_SESSION['success_user'];
                    echo '<i class="ace-icon fa fa-success green"></i> <a style="color:green;font-size:10px;">' . $login_feedback . '</a>';
                    unset($_SESSION['success_user']);
                }
                if (isset($_SESSION['success_signup'])) {
                    $login_feedback = $_SESSION['success_signup'];
                    echo '<i class="ace-icon fa fa-success green"></i> <a style="color:green;font-size:10px;">' . $login_feedback . '</a>';
                    unset($_SESSION['success_signup']);
                }
            }

            ?>
        </div>
        </form>
        <form id="forgot_password_submit" action="" method="post">
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <input type="hidden" name="forgot" value="forgot" />
                <a onclick="document.getElementById('forgot_password_submit').submit();">forgot
                    password?</a>
            </div>
        </form>
        <?php
        if (isset($_POST['forgot'])) {
            $_SESSION['forgot_pass'] = true;
        }
        ?>
    </div>

</div>

<!-- 
<div class="row">
    <form action="./homepage/login/models/login.php" method="post" role="form" class="contactForm lead">
        <div class="row">
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <label style="font-size:12px;">Username/Email</label>
                <input type="text" name="Uname" class="form-control input-sm" required />
            </div>
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <label style="font-size:12px;">Password</label>
                <input type="password" name="password" class="form-control input-sm" required />
            </div>
            <div class="col-sm-3 col-sm-3 col-sm-3">
                <label style="font-size:12px;">&nbsp;</label>
                <button style="font-size:12px;" type="submit" value="login" class="btn btn-skin btn-block btn-sm">Login</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <?php if (isset($_SESSION['error_user']) || isset($_GET['notify'])) {
                    if (isset($_SESSION['error_user'])) {
                        $error_user = $_SESSION['error_user'];
                        echo '<a style="color:red;font-size:14px;">' . $error_user . '</a>';
                        unset($_SESSION['error_user']);
                    }
                    if (isset($_GET['success_user'])) {
                        $notify = $_GET['notify'];
                        echo '<a style="color:red;font-size:14px;">' . $notify . '</a>';
                    }
                }

                if (isset($_SESSION['success_user']) || isset($_SESSION['success_signup'])) {
                    // accept & display login feedback
                    if (isset($_SESSION['success_user'])) {
                        $login_feedback = $_SESSION['success_user'];
                        echo '<i class="ace-icon fa fa-success green"></i> <a style="color:green;font-size:14px;">' . $login_feedback . '</a>';
                        unset($_SESSION['success_user']);
                    }
                    if (isset($_SESSION['success_signup'])) {
                        $login_feedback = $_SESSION['success_signup'];
                        echo '<i class="ace-icon fa fa-success green"></i> <a style="color:green;font-size:14px;">' . $login_feedback . '</a>';
                        unset($_SESSION['success_signup']);
                    }
                }

                ?>
            </div>
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <form id="forgot_password_submit" action="" method="post">
                    <div class="col-sm-4 col-sm-4 col-sm-4">
                        <input type="hidden" name="forgot" value="forgot" />
                        <a href="javascript:{}" onclick="document.getElementById('forgot_password_submit').submit();">forgot
                            password?</a>
                    </div>
                </form>
                <?php
                if (isset($_POST['forgot'])) {
                    $_SESSION['forgot_pass'] = true;
                }
                ?>
            </div>
        </div>
    </form>
</div> -->