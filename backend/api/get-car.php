<?php

require_once "./../classes/cars.class.php";

$car = new Cars();


try {
    if (!isset($_POST['car_id']) || empty($_POST['car_id'])) {
        throw new Exception('No car ID provided');
    }

    $cars = new Cars();
    $car = $cars->getCarById($_POST['car_id']);
    
    header('Content-Type: application/json');
    echo json_encode([$car]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}

?>