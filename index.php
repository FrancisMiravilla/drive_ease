<?php

require_once __DIR__ . "/backend/classes/cars.class.php";
require_once __DIR__ . "/includes/navbar.php";
$cars = new Cars();
$carList = $cars->getAllCars(); // Assuming this fetches all cars

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once __DIR__ . "/includes/requirement.php" ?>
  <title>Home</title>
</head>

<body>
  <main class="overflow-x-hidden">

    
    <img class="hidden sm:fixed" src="./assets/images/race-track.jpg" alt="">

    <section
      class="relative h-screen xl:h-[940px] overflow-hidden bg-[url('./assets/images/race-track.jpg')] bg-cover bg-center">
      <div
        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-[200%] md:w-[125%] h-[40%] bg-white rounded-t-[80%] shadow-lg">
      </div>


      <div class="absolute flex flex-col items-center justify-center bottom-[20%] h-64 inset-x-0 mx-auto">
        <img id="car-image" src="<?= $carList[0]['car_img']; ?>" class="sm:44 md:h-auto max-h-96" alt="Car Image">
        <h1 class="mx-auto mb-4 inset-x-0 text-center text-5xl font-bold" id="model_name">Porsche GT2 RS</h1>
        <p class="mx-auto mb-6 max-w-md inset-x-0 text-lg text-center text-gray-600" id="description">Uncompromising
          sports performance
          combined with high comfort and exclusive feel</p>

        <div class="flex items-center justify-center gap-4">
          <a id="buy_now" href="#" class="py-2.5 px-8 w-fit bg-orange-600 text-white rounded-full text-sm">Buy Now</a>
        </div>
      </div>
    </section>
  </main>

  <script>
    // List of car data: image, model name, and description
    const cars = [
      <?php
      foreach ($carList as $car) {
        echo json_encode([
          'img' => $car['car_img'],
          'model' => $car['model'],  // assuming this is the correct field name
          'description' => $car['description'],
          'car_id' => $car['car_id'],
        ]) . ',';
      }
      ?>
    ];

    let currentIndex = 0;

    function changeCarImage() {
      const car = cars[currentIndex];
      document.getElementById('car-image').src = car.img;
      document.getElementById('model_name').textContent = car.model;
      document.getElementById('description').textContent = car.description;
      document.getElementById('buy_now').setAttribute("href", `/drive-ease/car-info.php?car=${car.car_id}`);

      currentIndex = (currentIndex + 1) % cars.length;
    }

    changeCarImage();
    setInterval(changeCarImage, 5000);

    function autoScrollDown() {
      window.scrollBy(0, 1);
      setTimeout(autoScrollDown, 10);
    }

    // window.onload = function () {
    //   autoScrollDown();
    // };
  </script>

</body>

</html>