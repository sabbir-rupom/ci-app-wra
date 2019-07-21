<div class="row">
    <div class="col-md-12">
        <h2>Item List</h2>
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

        echo '<div class="table-responsive">';

        $template = array(
            'table_open' => '<table class="table">',
            'thead_open' => '<thead class="thead-light">',
            'heading_cell_start' => '<th scope="col">',
        );

        $this->table->set_template($template);


        $this->table->set_heading('#', 'Name', 'Description', 'Image', 'Action');
//        $this->table->add_row('Fred', 'Blue', 'Small');

        if (!empty($itemList)) {
            foreach ($itemList as $key => $item) {
                $imageUrl = empty($item->image) ? '' : base_url(IMAGE_STORAGE_PATH) . 'item/' . $item->image;
                $this->table->add_row(
                        ($key + 1),
                        $item->name,
                        nl2br($item->description),
                        '<img class="img-fluid img-table" src="' . $imageUrl . '">',
                        '<a class="btn btn-sm btn-info text-light" href="' . base_url('admin/item/edit/' . $item->id) . '" >Edit</a> '
                        . '<a class="btn btn-sm btn-danger text-light" href="' . base_url('admin/item/delete/' . $item->id) . '">Delete</a>'
                );
                ?>
                <?php
            }
        }

        echo '</div>';

        echo $this->table->generate();

        $this->table->clear();
        ?>

    </div>
</div>