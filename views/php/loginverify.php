<?php

    if(isset($_POST['MB_login'])):
        $userName = $_POST['MB_user_name'];
        $password = $_POST['MB_password'];

    else:
            echo 'none';
    endif;
