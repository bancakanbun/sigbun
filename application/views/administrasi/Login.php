    <div class="container-fluid">
        <div class="login-box">
            <form>
                <div class="alert alert-danger" role="alert" style="display:none">
                    <strong>Username</strong> tidak terdaftar atau <strong>password</strong> salah 
                </div>
                <div class="form-group">
                    <input type="text" class="form-control input-lg" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control input-lg" id="password" placeholder="Password">
                </div>
                <div class="form-group" style="padding-top:10px;">
                    <button type="button" class="btn btn-success btn-lg btn-block" id="btnLogin">Sign in</button>
                </div>
                <div class="form-group" style="padding-top:0px;margin-bottom:5px;text-align:right;">
                    <a href="<?php echo site_url('home'); ?>">Masuk tanpa login &raquo;</a>
                </div>
            </form>
        </div>
    </div>
