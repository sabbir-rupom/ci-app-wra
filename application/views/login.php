<!DOCTYPE html>
<html>
    <?php
    /**
     * Site Header Template
     */
    $this->load->view('template/admin/header');
    ?>
    <body class="bg-info">
        <div class="container vh-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-4">
                    <div class="card bg-light">
                        <article class="card-body">
                            <h4 class="card-title text-center mb-4 mt-1">Admin Login</h4>
                            <p class="text-center">
                                <?php echo validation_errors(); ?>
                            </p>
                            <form method="post" action="<?= base_url('admin/login'); ?>">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                        </div>
                                        <input name="username" class="form-control" placeholder="Username / Email" type="text" required="true" value="<?php echo set_value('username'); ?>" >
                                    </div> 
                                </div> 
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                        </div>
                                        <input class="form-control" name="password" placeholder="Password" type="password" required="true" value="<?php echo set_value('password'); ?>" >
                                    </div> 
                                </div> 
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                                </div>
                            </form>
                        </article>
                    </div>
                </div>   
            </div>
        </div>
    </body>
</html>