<?php

require_once __DIR__ . "/database.class.php";

class Users extends Database
{
  public function getAllUsers()
  {
    $query = $this->conn->prepare("SELECT * FROM users WHERE role = 'USER'");

    if ($query->execute())
      return $query->fetchAll();

    return [];
  }

  public function getUserById($user_id)
  {
    $query = $this->conn->prepare("SELECT * FROM users WHERE user_id = :user_id AND role = 'USER'");

    if ($query->execute(["user_id" => $user_id]))
      return $query->fetchAll();

    return [];
  }

  public function upsertUser($data)
  {
    if (!isset($data['user_id'])) {
      $data['user_id'] = NULL;
    }

    $columns = "(user_id, username, password)";
    $placeholders = "(:user_id, :username, :password)";

    $updateClause = "
        username = VALUES(username),
        password = VALUES(password)
      ";

    $sql = "INSERT INTO users $columns VALUES $placeholders ON DUPLICATE KEY UPDATE $updateClause";
    var_dump($data);
    $query = $this->conn->prepare($sql);
    $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

    $query->bindParam(':user_id', $data["user_id"]);
    $query->bindParam(':username', $data['username']);
    $query->bindParam(':password', $hashed_password);

    if (!$query->execute()) {
      throw new Exception("Error upserting user!");
    }
  }

  public function deleteUser($user_id)
  {
    $query = $this->conn->prepare("DELETE FROM users WHERE user_id = :user_id");
    if (!$query->execute(['user_id' => $user_id])) {
      throw new Exception("Error deleting user!");
    }
  }

  public function login($username, $password)
  {
    $query = $this->conn->prepare("SELECT * FROM users WHERE username = :username");

    if ($query->execute(['username' => $username])) {
      $user = $query->fetch();

      if ($user && password_verify($password, $user['password'])) {
        session_start();


        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];


        if ($user["role"] == "ADMIN") {
          header('Location: /drive-ease/admin/index.php');
          exit;
        }

        $url = $_SERVER['HTTP_REFERER'];

        $parsed_url = parse_url($url);
        $base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];

        header("Location: $base_url?result=success");
        exit;
      } else {
        $url = $_SERVER['HTTP_REFERER'];
        $parsed_url = parse_url($url);
        $base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'];

        header("Location: $base_url?result=invalid");
        exit;
      }
    }

    return false;
  }

}

?>