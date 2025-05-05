<?php
    $password = "Miravilla1234";
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    echo $password_hash;



?>