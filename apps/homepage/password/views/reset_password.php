<div class="row">
    <form action="" method="post" role="form" class="contactForm lead">
        <div class="row">
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <label style="font-size:12px;">Password</label>
                <input type="password" name="Pword" id="password" onkeyup="validate_Passwords('password')"
                    placeholder="New Password" class="form-control input-sm" required />
            </div>
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <label style="font-size:12px;">Confirm</label>
                <input type="password" name="CPword" id="C_password" onkeyup="Pwd_match('C_password')"
                    onblur="validate_Confirm()" placeholder="Confirm Password" class="form-control input-sm" required />
            </div>
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <label style="font-size:12px;">&nbsp;</label>
                <button type="submit" name="change_password" class="btn btn-skin btn-block btn-sm"
                    style="font-size:12px;">Change password</button>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <span id="PasswordErr"></span>
            </div>
            <div class="col-sm-4 col-sm-4 col-sm-4">
                <span id="confirmErr"></span>
            </div>
        </div>
    </form>
</div>