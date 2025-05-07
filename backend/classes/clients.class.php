<?php

require_once __DIR__ . "/database.class.php";

class Clients extends Database
{

  public function getAllClients()
  {
    $query = $this->conn->prepare("SELECT * FROM bookings b INNER JOIN users u ON b.user_id=u.user_id INNER JOIN cars c ON c.car_id=b.car_id");

    if ($query->execute())
      return $query->fetchAll();

    return [];
  }

  public function createClient($data)
{
    try {
        if ($data["payment_method"] === "INSTALLMENT") {
            $query = "INSERT INTO bookings 
                (user_id, car_id, name, phone, address, city, payment_method, payment_status, downpayment, monthly_payment, installment_months) 
                VALUES 
                (:user_id, :car_id, :name, :phone, :address, :city, :payment_method, :payment_status, :downpayment, :monthly_payment, :installment_months)";

            $stmt = $this->conn->prepare($query);

            $stmt->execute([
                ':user_id' => $data['user_id'],
                ':car_id' => $data['car_id'],
                ':name' => $data['name'],
                ':phone' => $data['phone'],
                ':address' => $data['address'],
                ':city' => $data['city'],
                ':payment_method' => $data['payment_method'],
                ':payment_status' => 'Pending',
                ':downpayment' => $data['downpayment'],
                ':monthly_payment' => $data['monthly_payment'],
                ':installment_months' => $data['installment_months']
            ]);
        } else {
            // CASH booking
            $query = "INSERT INTO bookings 
                (user_id, car_id, name, phone, address, city, payment_method, payment_status) 
                VALUES 
                (:user_id, :car_id, :name, :phone, :address, :city, :payment_method, :payment_status)";

            $stmt = $this->conn->prepare($query);

            $stmt->execute([
                ':user_id' => $data['user_id'],
                ':car_id' => $data['car_id'],
                ':name' => $data['name'],
                ':phone' => $data['phone'],
                ':address' => $data['address'],
                ':city' => $data['city'],
                ':payment_method' => $data['payment_method'],
                ':payment_status' => 'Complete'
            ]);
        }

        return true;
    } catch (PDOException $e) {
        error_log("Booking Insert Error: " . $e->getMessage());
        return false;
    }
}

  public function updatePaymentStatus($booking_id, $new_status)
  {
    try {
      $query = "UPDATE bookings SET payment_status = :status WHERE booking_id = :booking_id";
      $stmt = $this->conn->prepare($query);
      $stmt->execute([
        ':status' => $new_status,
        ':booking_id' => $booking_id,
      ]);
      return true;
    } catch (PDOException $e) {
      error_log("Payment Status Update Error: " . $e->getMessage());
      return false;
    }
  }
  public function deleteBooking($booking_id)
  {
    try {
      $query = "DELETE FROM bookings WHERE booking_id = :booking_id";
      $stmt = $this->conn->prepare($query);
      $stmt->execute([
        ':booking_id' => $booking_id,
      ]);
      return true;
    } catch (PDOException $e) {
      error_log("Booking Delete Error: " . $e->getMessage());
      return false;
    }
  }
}
