<?php

// require_once "./../classes/cars.class.php";

// $car = new Cars();

// $car->deleteCar($_GET["car_id"]);

// header("Location: ../../admin/cars.php")


require_once __DIR__ . "/../classes/cars.class.php";

try {
    // Validate POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Validate car_id
    if (!isset($_POST['car_id']) || empty($_POST['car_id'])) {
        throw new Exception('No car ID provided');
    }

    $car_id = $_POST['car_id'];
    error_log("Processing delete request for car ID: " . $car_id);
    
    $cars = new Cars();
    if ($cars->deleteCar($car_id)) {
        header("Location: /drive-ease/admin/cars.php?result=deleted");
        exit;
    }
    
    throw new Exception("Failed to delete car ID: " . $car_id);

} catch (Exception $e) {
    error_log("Error in delete-car.php: " . $e->getMessage());
    header("Location: /drive-ease/admin/cars.php?error=delete_failed&message=" . urlencode($e->getMessage()));
    exit;
}


  ?>