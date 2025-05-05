<?php
session_start();
require_once "./../classes/clients.class.php";

$clients = new Clients();
$clients->updatePaymentStatus($_POST["booking_id"], $_POST["payment_status"]);

header("Location: " . $_SERVER['HTTP_REFERER']);

?>