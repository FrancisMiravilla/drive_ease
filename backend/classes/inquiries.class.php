<?php

require_once __DIR__ . "/database.class.php";

class Inquiries extends Database
{
  // Insert a new inquiry using $data array
  public function insert($data)
  {
    var_dump($data);

    $sql = "INSERT INTO inquiries (first_name, last_name, email, subject, message) 
                VALUES (:first_name, :last_name, :email, :subject, :message)";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
      ':first_name' => $data['first_name'],
      ':last_name' => $data['last_name'],
      ':email' => $data['email'],
      ':subject' => $data['subject'],
      ':message' => $data['message'],
    ]);
  }

  // Retrieve all inquiries
  public function getAllInquiries()
  {
    $sql = "SELECT * FROM inquiries ORDER BY inquiry_id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>