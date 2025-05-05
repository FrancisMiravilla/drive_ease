<?php
session_start();
require_once "./../classes/clients.class.php";

if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
  header("Location: /drive-ease/sign-in.php?error=login_required");
  exit;
}

$clients = new Clients();

$data = [
  "user_id" => $_SESSION["user_id"] ?? 0, // fallback for testing
  "car_id" => $_POST["car_id"],
  "name" => $_POST["name"],
  "phone" => $_POST["phone"],
  "address" => $_POST["address"],
  "city" => $_POST["city"],
  "payment_method" => $_POST["payment_method"]
];

// Add installment-specific fields only if payment method is INSTALLMENT
if ($_POST["payment_method"] === "INSTALLMENT") {
  $data["downpayment"] = $_POST["downpayment"];
  $data["monthly_payment"] = $_POST["monthly_payment"];
  $data["installment_months"] = $_POST["installment_months"];
}

$success = $clients->createClient($data);
// var_dump($success)
if ($success) {
  header("Location: /drive-ease/thank-you.php");
  exit;
} else {
  echo "Failed to book the car.";
}

?>