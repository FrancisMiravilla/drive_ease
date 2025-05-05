<?php
session_start();
require_once __DIR__ . "/backend/classes/cars.class.php";

$cars = new Cars();
$car = $cars->getCarById($_GET["car"]);
extract($car);

$downpayment = $price * 0.20;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <?php require_once __DIR__ . "/includes/requirement.php" ?>
  <title><?= $model ?> | DriveEase</title>
</head>

<body class="bg-gray-100">

  <?php require_once __DIR__ . "/includes/navbar.php" ?>

  <main class="mt-24 pb-12 container mx-auto px-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <!-- Car Info -->
      <div class="flex flex-col gap-8">
        <div class="h-fit bg-white p-6 rounded-lg shadow">
          <img src="<?= $car_img ?>" class="w-full h-64 object-cover rounded-lg mb-4" alt="<?= $model ?>" />
          <h1 class="text-2xl font-semibold mb-2"><?= $model ?></h1>
          <p class="text-sm text-gray-600 mb-4"><?= $description ?></p>
          <div class="flex justify-between text-lg font-medium">
            <span>Subtotal</span>
            <span>₱<?= number_format($price) ?></span>
          </div>
          <hr class="my-2" />
          <div class="flex justify-between text-lg font-medium">
            <span>Total</span>
            <span>₱<?= number_format($price) ?></span>
          </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
          <h2 class="text-xl font-semibold mb-2">Car Specifications</h2>
          <p class="text-sm text-gray-500 mb-4">Breakdown of detailed car reservations.</p>
          <ul class="grid grid-cols-2 gap-8">
            <li>
              <span class="font-medium text-sm">Model</span>
              <p><?= $model ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Category</span>
              <p><?= $category ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Year</span>
              <p><?= $year ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Car Condition</span>
              <p><?= $car_condition ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Mileage</span>
              <p><?= $mileage ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Engine</span>
              <p><?= $engine ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Transmission</span>
              <p><?= $transmission ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Fuel Efficiency</span>
              <p><?= $fuel_efficiency ?></p>
            </li>
            <li>
              <span class="font-medium text-sm">Seating Capacity</span>
              <p><?= $seating_capacity ?></p>
            </li>
          </ul>
        </div>
      </div>

      <!-- Booking Form -->
      <div class="bg-white p-6 rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-2">Billing Information</h2>
        <p class="text-sm text-gray-500 mb-4">Enter your details to book the car.</p>

        <form action="/drive-ease/backend/api/book-car.php" method="POST">
          <input type="hidden" name="user_id" value="<?= isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : '' ?>">
          <input type="hidden" name="car_id" value="<?= $car_id ?>">

          <div class="grid sm:grid-cols-2 gap-4">
            <div>
              <label class="text-sm block mb-1">Name</label>
              <input type="text" name="name" class="w-full h-9 rounded-lg border px-3 bg-zinc-100" />
            </div>
            <div>
              <label class="text-sm block mb-1">Phone Number</label>
              <input type="text" name="phone" class="w-full h-9 rounded-lg border px-3 bg-zinc-100" />
            </div>
            <div>
              <label class="text-sm block mb-1">Address Line</label>
              <input type="text" name="address" class="w-full h-9 rounded-lg border px-3 bg-zinc-100" />
            </div>
            <div>
              <label class="text-sm block mb-1">City</label>
              <input type="text" name="city" class="w-full h-9 rounded-lg border px-3 bg-zinc-100" />
            </div>
          </div>

          <h2 class="text-xl font-semibold mt-8">Payment Method</h2>
          <p class="text-sm text-gray-500 mb-4">Choose your payment option</p>

          <div class="grid grid-cols-2 gap-4">
            <label class="flex items-center gap-2 bg-zinc-100 px-4 py-2.5 rounded-lg">
              <input type="radio" name="payment_method" id="payment_installment" value="INSTALLMENT" checked />
              <span class="text-sm">Installment</span>
            </label>
            <label class="flex items-center gap-2 bg-zinc-100 px-4 py-2.5 rounded-lg">
              <input type="radio" name="payment_method" id="payment_cash" value="CASH" />
              <span class="text-sm">Cash (On-site)</span>
            </label>
          </div>

          <!-- Installment Section -->
          <section id="installment-section" class="mt-4">
            <div class="mt-4">
              <label class="text-sm block mb-1">Initial Downpayment (Minimum 20%)</label>
              <input type="number" name="downpayment" id="downpaymentInput" value="<?= round($downpayment) ?>"
                min="<?= round($downpayment) ?>" class="w-full h-9 rounded-lg border px-3 bg-zinc-100" />
            </div>

            <div class="grid gap-3 mt-4">
              <label class="flex items-center gap-2 bg-zinc-100 px-4 py-2.5 rounded-lg">
                <input type="radio" name="monthly_payment" class="monthly-radio" data-months="12"
                  value="<?= round($monthly12) ?>" checked />
                <span class="text-sm monthly-label">12 months – ₱<?= number_format($monthly12, 0) ?>/month</span>
              </label>
              <label class="flex items-center gap-2 bg-zinc-100 px-4 py-2.5 rounded-lg">
                <input type="radio" name="monthly_payment" class="monthly-radio" data-months="24"
                  value="<?= round($monthly24) ?>" />
                <span class="text-sm monthly-label">24 months – ₱<?= number_format($monthly24, 0) ?>/month</span>
              </label>
              <label class="flex items-center gap-2 bg-zinc-100 px-4 py-2.5 rounded-lg">
                <input type="radio" name="monthly_payment" class="monthly-radio" data-months="36"
                  value="<?= round($monthly36) ?>" />
                <span class="text-sm monthly-label">36 months – ₱<?= number_format($monthly36, 0) ?>/month</span>
              </label>
              <label class="flex items-center gap-2 bg-zinc-100 px-4 py-2.5 rounded-lg">
                <input type="radio" name="monthly_payment" class="monthly-radio" data-months="48"
                  value="<?= round($monthly48) ?>" />
                <span class="text-sm monthly-label">48 months – ₱<?= number_format($monthly48, 0) ?>/month</span>
              </label>
            </div>

            <!-- Hidden field to track months -->
            <input type="hidden" name="installment_months" id="installmentMonthsInput" value="12" />
          </section>

          <button type="submit"
            class="mt-6 w-full py-2.5 rounded-lg bg-orange-600 text-white text-sm hover:bg-orange-700">
            Book Now
          </button>
        </form>
      </div>
    </div>
  </main>

  <script>
    const installmentRadio = document.getElementById("payment_installment");
    const cashRadio = document.getElementById("payment_cash");
    const installmentSection = document.getElementById("installment-section");
    const downpaymentInput = document.getElementById("downpaymentInput");
    const carPrice = <?= $price ?>;
    const minDownpayment = Math.round(carPrice * 0.20);
    const monthlyRadios = document.querySelectorAll(".monthly-radio");
    const monthlyLabels = document.querySelectorAll(".monthly-label");

    function toggleInstallmentFields() {
      installmentSection.classList.toggle("hidden", !installmentRadio.checked);
    }

    function updateMonthlyPayments() {
      let downpayment = parseInt(downpaymentInput.value);
      if (isNaN(downpayment) || downpayment < minDownpayment) {
        downpaymentInput.value = minDownpayment;
        downpayment = minDownpayment;
      }

      const balance = carPrice - downpayment;
      const terms = [12, 24, 36, 48];

      monthlyRadios.forEach((radio, index) => {
        const months = terms[index];
        const monthly = Math.round(balance / months);
        radio.value = monthly;
        radio.setAttribute("data-months", months);
        monthlyLabels[index].textContent = `${months} months – ₱${monthly.toLocaleString()}/month`;
      });

      const selected = document.querySelector("input[name='monthly_payment']:checked");
      if (selected) {
        document.getElementById("installmentMonthsInput").value = selected.getAttribute("data-months");
      }
    }

    // Update months hidden input on radio select
    monthlyRadios.forEach(radio => {
      radio.addEventListener("change", () => {
        document.getElementById("installmentMonthsInput").value = radio.getAttribute("data-months");
      });
    });

    // Event listeners
    installmentRadio.addEventListener("change", toggleInstallmentFields);
    cashRadio.addEventListener("change", toggleInstallmentFields);
    downpaymentInput.addEventListener("input", updateMonthlyPayments);

    // Init on load
    window.addEventListener("DOMContentLoaded", () => {
      toggleInstallmentFields();
      updateMonthlyPayments();
    });
  </script>

</body>

</html>