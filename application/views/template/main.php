<?php
header('Expires: Sun, 01 Jan 2019 00:00:00 GMT');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

ob_start(); // Start Output Buffering

/**
 * Set Template Prefix
 */
if (stristr($mainView, 'admin')) {
    $templatePrefix = 'template/admin/';
} else {
    $templatePrefix = 'template/front/';
}
?>
<!DOCTYPE html>
<html>
    <?php
    /**
     * Site Header Template
     */
    $this->load->view($templatePrefix . 'header');
    ?>
    <body>
        <?php
        /**
         * Site Sidebar Template 
         */
        $this->load->view($templatePrefix . 'sidebar');
        ?>
        <div class="main-content">
            <?php
            /**
             * Site Navigation-bar Template
             */
            $this->load->view($templatePrefix . 'navbar');
            ?>
            <!--<Main Body>-->
            <div id="page_content">
                <div class="container-fluid">
                    <?php
                    /**
                     * Site Body Content Template
                     */
                    $this->load->view($mainView);
                    ?>
                </div>
            </div>
        </div>
        <?php
        /**
         * Site Footer Template
         */
        $this->load->view($templatePrefix . 'footer');
        ?>
    </body>
</html>
<?php
ob_flush(); // Flush Output Buffer
