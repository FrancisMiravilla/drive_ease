<?php
session_start();
require_once "./../classes/clients.class.php";

$clients = new Clients();
$clients->deleteBooking($_POST["booking_id"]);

header("Location: " . $_SERVER['HTTP_REFERER']);


?>