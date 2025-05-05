<?php

require_once "./../classes/users.class.php";

$car = new Users();

$car->login($_POST["username"], $_POST["password"]);

?>