<?php

require_once "./../classes/users.class.php";

$car = new Users();

$car->upsertUser($_POST);

header("Location: " . $_SERVER['HTTP_REFERER'] . "?result=success");
header("Location: /drive-ease/sign-in.php?result=success");
?>