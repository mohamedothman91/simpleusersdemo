<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Users</a>
            </li>
            <li class="breadcrumb-item active">Add User</li>
        </ol>
        <!-- Icon Cards-->

        <div class="card  mb-12">

            <div class="card-body">
                <?php
                            // `id`, `first_name`, `last_name`, `email`, `password`,
                        //  `company`, `title`, `address`, `city`, `phone`
                            if (isset($error)) {
                                echo '<div class="alert alert-danger ">'.$error.'</div>';
                            } elseif (isset($done)) {
                                echo '<div class="alert alert-success ">'.$done.'</div>';
                            }
                            $arrayattr = array('role'=>'form' , 'id'=>'validate');
                            echo   form_open('users/add', $arrayattr);

                        ?>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputName">First name</label>
                            <input name="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control"
                                id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputLastName">Last name</label>
                            <input name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control"
                                id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" value="<?php echo set_value('email'); ?>" class="form-control"
                        id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password" class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleConfirmPassword">Confirm password</label>
                            <input name="passconf" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="company">Company</label>
                            <input name="company" value="<?php echo set_value('company'); ?>" class="form-control"
                                id="company" type="text" placeholder="Company">
                        </div>
                        <div class="col-md-6">
                            <label for="title">Title</label>
                            <input name="title" value="<?php echo set_value('title'); ?>" class="form-control"
                                id="title" type="text" placeholder="Title">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input name="address" value="<?php echo set_value('address'); ?>" class="form-control"
                        id="address" type="text" placeholder="Enter address">
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="city">Company</label>
                            <input name="city" value="<?php echo set_value('city'); ?>" class="form-control"
                                id="city" type="text" placeholder="City">
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Phone</label>
                            <input name="phone" value="<?php echo set_value('phone'); ?>" class="form-control"
                                id="phone" type="text" placeholder="Phone">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" name="save" value="save" type="submit">Save</button>


                <?php echo form_close(); ?>

            </div>
        </div>

    </div>
</div>