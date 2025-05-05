<?php
session_start();
session_destroy();
header("Location: /drive-ease/sign-in.php");

?>