<div class="row">
    <div class="col-md-12">
        <h2>
            Change Password
        </h2>
        <hr>

        <?php
        /**
         * Show result messages after a successful form submission
         */
        if ($this->session->has_userdata('success')) {
            ?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->userdata('success'); ?>
            </div>
            <?php
        } elseif ($this->session->has_userdata('error')) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?= $this->session->userdata('error'); ?>
            </div>
            <?php
        }
        ?>

        <form id="contentForm" action="<?= base_url('admin/password/change'); ?>" method="post">
            <div class="form-group row">
                <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password" required="">
                </div>
            </div>
            <div class="form-group row">
                <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New password" required="">
                </div>
            </div>
            <div class="form-group row">
                <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-2">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>

    </div>
</div>