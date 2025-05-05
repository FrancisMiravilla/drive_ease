<?php

require_once __DIR__ . "/database.class.php";

class Cars extends Database
{
  public function getAllCars()
  {
    $query = $this->conn->prepare("SELECT * FROM cars");

    if ($query->execute())
      return $query->fetchAll();

    return [];
  }

  public function getCarById($car_id)
  {
    $query = $this->conn->prepare("SELECT * FROM cars WHERE car_id = :car_id");

    if ($query->execute(["car_id" => $car_id]))
      return $query->fetch();

    return [];
  }

  public function upsertCar($data)
  {
    if (!isset($data['car_id'])) {
      throw new Exception("car_id is required for upsert.");
    }

    $columns = "(car_id, model, category, price, description, year, car_condition, mileage, engine, transmission, fuel_efficiency, seating_capacity, car_img)";
    $placeholders = "(:car_id, :model, :category, :price, :description, :year, :car_condition, :mileage, :engine, :transmission, :fuel_efficiency, :seating_capacity, :car_img)";

    $updateClause = "
        model = VALUES(model),
        category = VALUES(category),
        price = VALUES(price),
        description = VALUES(description),
        year = VALUES(year),
        car_condition = VALUES(car_condition),
        mileage = VALUES(mileage),
        engine = VALUES(engine),
        transmission = VALUES(transmission),
        fuel_efficiency = VALUES(fuel_efficiency),
        seating_capacity = VALUES(seating_capacity),
        car_img = VALUES(car_img)
      ";

    $sql = "INSERT INTO cars $columns VALUES $placeholders ON DUPLICATE KEY UPDATE $updateClause";

    $query = $this->conn->prepare($sql);

    $query->bindParam(':car_id', $data['car_id']);
    $query->bindParam(':model', $data['model']);
    $query->bindParam(':category', $data['category']);
    $query->bindParam(':price', $data['price']);
    $query->bindParam(':description', $data['description']);
    $query->bindParam(':year', $data['year']);
    $query->bindParam(':car_condition', $data['car_condition']);
    $query->bindParam(':mileage', $data['mileage']);
    $query->bindParam(':engine', $data['engine']);
    $query->bindParam(':transmission', $data['transmission']);
    $query->bindParam(':fuel_efficiency', $data['fuel_efficiency']);
    $query->bindParam(':seating_capacity', $data['seating_capacity']);
    $query->bindParam(':car_img', $data['car_img']);

    if (!$query->execute()) {
      throw new Exception("Error upserting car!");
    }
  }

  public function deleteCar($car_id)
  {
      try {
          // Validate car_id
          if (!$car_id || !is_numeric($car_id)) {
              error_log("Invalid car_id: " . $car_id);
              return false;
          }
  
          $query = $this->conn->prepare("DELETE FROM cars WHERE car_id = :car_id LIMIT 1");
          $query->bindValue(':car_id', $car_id, PDO::PARAM_INT);
          
          $result = $query->execute();
          error_log("Delete result for car_id {$car_id}: " . ($result ? 'success' : 'failed'));
          
          return $result;
      } catch (PDOException $e) {
          error_log("Database error in deleteCar: " . $e->getMessage());
          return false;
      }
  }

}

?>