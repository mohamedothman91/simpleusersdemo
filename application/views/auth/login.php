<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
            <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger ">'.$error.'</div>';
                } elseif (isset($done)) {
                    echo '<div class="alert alert-success ">'.$done.'</div>';
                }
                $arrayattr = array('role' => 'form', 'id' => 'validate');
                echo   form_open('Auth', $arrayattr);

            ?>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"> Remember Password</label>
                </div>
            </div>
            <button class="btn btn-primary btn-block" name="Login" value="Login" type="submit">Login</button>

            <a class="btn btn-danger btn-block" href="<?= base_url().'auth/googlelogin'; ?>">Google +</a>

            <?php echo form_close(); ?>

        </div>
    </div>
</div>