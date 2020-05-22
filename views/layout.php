<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title ?? 'Default Header'?></title>
    <link rel="stylsheet" href="<?=HOME?>assets/style.css">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/lib/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/lib/uikit.min.css">
    <link rel="stylesheet" href="./assets/<?=$css?>.css">


    <!-- add here more assets like booktstrap and ui kit -->
</head>
<body>
    <?php 
    if(isset($page) && file_exists(ROOT . 'views/' . $page . '.php')) {
        include_once ROOT . 'views/' . $page . '.php';
    }  ?>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="<?=HOME?>assets/lib/main.js"></script>
</body>
</html>