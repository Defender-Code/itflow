<?php

    // Calculate Execution time start
    // uncomment for test
    // $time_start = microtime(true);

header("X-Frame-Options: DENY");

// Determine URI prepending logic (URI Routing maybe move to /includes/router.php)
if ($_SERVER['REQUEST_URI'] === '/user/reports') {
    $prepend_uri = "../";
} else {
    $prepend_uri = '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex">

    <title><?php echo $session_company_name; ?></title>

    <!-- Favicon -->
    <?php if(file_exists($prepend_uri . '../uploads/favicon.ico')): ?>
        <link rel="icon" type="image/x-icon" href="<?= $prepend_uri ?>../uploads/favicon.ico">
    <?php endif; ?>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $prepend_uri ?>../plugins/fontawesome-free/css/all.min.css">

    <!-- Custom Styles -->
    <link href="<?= $prepend_uri ?>../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $prepend_uri ?>../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $prepend_uri ?>../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= $prepend_uri ?>../plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?= $prepend_uri ?>../plugins/toastr/toastr.min.css" rel="stylesheet">
    <link href="<?= $prepend_uri ?>../plugins/DataTables/datatables.min.css" rel="stylesheet">
    <link href="<?= $prepend_uri ?>../plugins/intl-tel-input/css/intlTelInput.min.css" rel="stylesheet">
    <link href="<?= $prepend_uri ?>../css/itflow_custom.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= $prepend_uri ?>../plugins/adminlte/css/adminlte.min.css">

    <!-- Scripts -->
    <script src="<?= $prepend_uri ?>../plugins/jquery/jquery.min.js"></script>
    <script src="<?= $prepend_uri ?>../plugins/toastr/toastr.min.js"></script>
</head>
<body class="
    hold-transition sidebar-mini layout-fixed layout-navbar-fixed 
    accent-<?php echo isset($_GET['client_id']) ? 'blue' : nullable_htmlentities($config_theme); ?>
    <?php if ($config_theme_dark) echo 'dark-mode'; ?>
">
    <div class="wrapper text-sm">

