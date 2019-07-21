<head>

    <meta charset="utf-8">
    <meta name="description" content="Air Entrance">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php echo link_tag('resources/image/favicon.png', 'icon', 'image/x-icon'); ?>
    <title><?= $pageTitle ?></title>

    <script type="text/javascript">
        var base_url = "<?php echo base_url(); ?>";
    </script>

    <?php
    /**
     * Library Resources
     */
    echo link_tag('resources/css/lib/bootstrap.min.css');
    echo link_tag('resources/css/lib/font-awesome.min.css');
    echo '<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700&amp;subset=latin-ext" rel="stylesheet">';

    echo SCRIPT . base_url('resources/js/lib/jquery.min.js') . END_SCRIPT;
    echo SCRIPT . base_url('resources/js/lib/popper.min.js') . END_SCRIPT;
    echo SCRIPT . base_url('resources/js/lib/bootstrap.min.js') . END_SCRIPT;

    /**
     * User Defined Resources
     */
    echo link_tag('resources/css/styles.css');
    echo SCRIPT . base_url('resources/js/custom.js') . END_SCRIPT;
    ?>

</head>
