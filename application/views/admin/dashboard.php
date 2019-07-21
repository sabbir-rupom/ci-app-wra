<div class="row">
    <div class="col-md-12">
        <h2>Dashboard</h2>
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

    </div>
</div>