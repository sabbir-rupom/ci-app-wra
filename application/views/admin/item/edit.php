<div class="row">
    <div class="col-md-12">
        <h2>
            Add Item
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

        <form id="contentForm" method="POST" action="<?= base_url('admin/item/edit/' . $itemInfo->id); ?>" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="itemName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="itemName" name="itemName" value="<?= $itemInfo->name; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control editor" name="itemDescription" id="itemDescription" rows="3" required="true"><?= $itemInfo->description; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Image</label>
                        <div class="col-sm-8">
                            <div class="custom-file" id="customFile">
                                <input type="file" class="custom-file-input" id="itemImage" name="itemImage" aria-describedby="fileHelp">
                                <label class="custom-file-label" for="itemImage">
                                    <?= $itemInfo->image; ?>
                                </label>
                            </div>
                            <small class="form-text text-muted">
                                File size not more than 2MB and must be greater than 400pixel in dimensions
                            </small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-8 offset-sm-4">
                            <input type="submit" class="btn btn-success" name="update" value="Update">
                            <input type="hidden" name="itemId" value="<?= $itemInfo->id; ?>">
                            <a class="btn btn-warning text-light" href="<?= base_url('admin/item/list'); ?>">Return</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div id="imagePreview">
                        <img class="img-fluid" src="<?= base_url(IMAGE_STORAGE_PATH . 'item/' . $itemInfo->image); ?>" />
                    </div>
                </div>

            </div>

        </form>
    </div>
</div>