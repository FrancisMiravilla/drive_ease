<?php
session_start();
require_once "./../classes/inquiries.class.php";

$inquiries = new Inquiries();

$success = $inquiries->insert($_POST);

if ($success) {
  header("Location: /drive-ease/message-sent.php");
  exit;
} else {
  echo "Failed to book the car.";
}

?>