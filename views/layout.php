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

    <!-- same as here, add your scripts like jquery and others plugins. then we will continue this project. not today. you just need to understand the core right nw. go through the project and classes how it works. its the fundamentakl of all MVC framework. this is also one of my tiny framework for rest API you should go through the project first. learn how routes and controler / metho works. get first what I did to make simply it. then we wil continue. -->
</body>
</html>