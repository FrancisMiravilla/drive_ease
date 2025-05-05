<?php

require_once "./../classes/cars.class.php";

$car = new Cars();

$car->upsertCar($_POST);

header("Location: ../../admin/cars.php")
  ?>