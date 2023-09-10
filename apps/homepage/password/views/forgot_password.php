<?php
include('common/email/email-send.php');
?>
<div class="row">
    <form action="" method="post" role="form" class="contactForm lead">

        <div class="col-sm-6 col-sm-6 col-sm-6">
            <label style="font-size:12px;">Email</label>
            <input type="text" id="email" name="Uname" placeholder="input your email" class="form-control input-sm" required />
        </div>
        <div class="col-sm-6 col-sm-6 col-sm-6">
            <label style="font-size:12px;">&nbsp;</label>
            <span style="font-size:12px;" onclick="searchaccount();" class="btn btn-skin btn-block btn-sm">Search Account &nbsp;</span>
        </div>
        <span class="col-sm-6 col-sm-6 col-sm-6">
            <?php if (isset($_SESSION['success_user'])) {
                $login_feedback = $_SESSION['success_user'];
                echo '<i class="ace-icon fa fa-success green"></i> <a style="color:green;font-size:14px;">' . $login_feedback . '</a>';
                unset($_SESSION['success_user']);
            }
            ?>
        </span>
    </form>
    <?php include('homepage/password/views/searchaccount.php'); ?>
    <br>
    <span id="message">
    </span>

</div>
<div class="row">
    <form id="back_home_submit" action="" method="post">
        <input type="hidden" name="back_home" value="back-home" />
        <div class="col-sm-6 col-sm-6 col-sm-6">
            <a style="font-size:14px;" href="javascript:{}" onclick="document.getElementById('back_home_submit').submit();">&nbsp; <i class="fa fa-arrow-left"></i> back to login</a>
        </div>
    </form>
    <?php
    if (isset($_POST['back_home'])) {
        unset($_SESSION['forgot_pass']);
        echo "<script> location.reload(); </script>";
    }
    ?>
</div>

<?php include('homepage/password/models/forget_pass_mail_send.php') ?>