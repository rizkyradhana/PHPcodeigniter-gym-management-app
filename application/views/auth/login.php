<div class="container" style="margin-top: 10px;  border: 10px;">
    <div class="row mt-3">
        <div class="col-md-12">
            <h1 style="text-align: center;">Executive Gym App</h1>
            <div class="card" style="width: 25rem; margin: 0 auto;">
            <h1 style="text-align: center;">Login</h1>
            <img src="<?=base_url()?>assets/img/gym2.jpg" class="card-img-top" alt="...">
                <div class="card-body" >
                    <form method="post" action="">
                    <div class="form-group ">
                        <label for="username">Username: </label>
                        <input type="text" class="form-control" id="username" name="username" autocomplete="off">
                        <small class="form-text text-danger"><?=form_error('username');?></small>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <small class="form-text text-danger"><?=form_error('password');?></small>
                        <?php if ($error): ?>
                        <small class="form-text text-danger">username/password incorrect</small>
                        <?php endif;?>
                    </div>
                    <input type="submit" name="login" value="Login" class="btn btn-primary float-right"></input>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
