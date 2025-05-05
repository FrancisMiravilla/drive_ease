<?php

require_once __DIR__ . "/backend/classes/cars.class.php";
$cars = new Cars();
$carsList = $cars->getAllCars();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once __DIR__ . "/includes/requirement.php" ?>
  <title>Home</title>
  <script>
    // Function to filter cars based on selected category
    function filterCars() {
      // Get selected category
      const selectedCategory = document.querySelector('input[name="category"]:checked')?.value;

      // Get all car elements
      const cars = document.querySelectorAll('.car-item');

      // Show/hide cars based on category
      cars.forEach(car => {
        const carCategory = car.getAttribute('data-category');
        if (!selectedCategory || carCategory === selectedCategory) {
          car.style.display = 'block'; // Show the car
        } else {
          car.style.display = 'none'; // Hide the car
        }
      });
    }

    // Reset all filters
    function resetFilters() {
      // Uncheck all radio buttons and show all cars
      document.querySelectorAll('input[name="category"]').forEach(input => input.checked = false);
      const cars = document.querySelectorAll('.car-item');
      cars.forEach(car => car.style.display = 'block');
    }
  </script>
</head>

<body>
  <main class="overflow-x-hidden px-24">
    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <section class="mt-24">
      <h1 class="text-2xl font-bold">Available Cars</h1>
      <p>Find your perfect ride from our selection</p>
    </section>

    <section class="mt-12 grid grid-cols-5 gap-8">
      <aside class="w-full h-96 border p-4 rounded-xl">
        <h1 class="text-lg font-medium">Filters</h1>
        <button onclick="resetFilters()" class="py-2 px-4 text-sm hover:bg-zinc-200 rounded border mt-4">
          Reset All
        </button>

        <hr class="my-4">
        <ul class="space-y-1">
          <li class="font-medium text-sm">Category</li>
          <li>
            <div class="flex items-center gap-1.5 text-sm">
              <input type="radio" name="category" value="Sedan" class="mt-0.5" onchange="filterCars()">
              <span>Sedan</span>
            </div>
          </li>
          <li>
            <div class="flex items-center gap-1.5 text-sm">
              <input type="radio" name="category" value="SUV" class="mt-0.5" onchange="filterCars()">
              <span>SUV</span>
            </div>
          </li>
          <li>
            <div class="flex items-center gap-1.5 text-sm">
              <input type="radio" name="category" value="Sport" class="mt-0.5" onchange="filterCars()">
              <span>Sports</span>
            </div>
          </li>
          <li>
            <div class="flex items-center gap-1.5 text-sm">
              <input type="radio" name="category" value="Van" class="mt-0.5" onchange="filterCars()">
              <span>Van</span>
            </div>
          </li>
        </ul>
      </aside>

      <section class="col-span-4">
        <div class="grid grid-cols-4 gap-4">
          <?php foreach ($carsList as $car): ?>
            <div class="w-full h-fit border rounded-2xl car-item"
              data-category="<?= htmlspecialchars($car['category']) ?>">
              <img src="<?= $car['car_img'] ?>" class="h-48 w-full object-cover" alt="">

              <div class="p-4">
                <div class="flex items-center justify-between">
                  <h1 class="font-medium"><?= htmlspecialchars($car['model']) ?></h1>
                  <span class="text-sm text-zinc-600 font-medium"><?= htmlspecialchars($car['year']) ?></span>
                </div>

                <h1 class="mb-1 text-lg font-bold">₱ <?= number_format($car['price']) ?></h1>

                <div class="flex flex-col flex-1 justify-end">
                  <span
                    class="py-0.5 border rounded-full w-12 px-2 text-xs"><?= htmlspecialchars($car['category']) ?></span>
                </div>
              </div>

              <div class="px-4 pb-4">
                <button onclick="javascript:window.location.replace('/drive-ease/car-info.php?car=<?= $car['car_id'] ?>')"
                  href="./car-info.php?car=<?= $car['car_id'] ?>"
                  class="w-full py-2 px-4 text-sm bg-orange-600 text-white hover:bg-orange-600/90 rounded-lg">
                  Book Now
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    </section>
  </main>
</body>

</html>