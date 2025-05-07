<?php

require_once __DIR__ . "/../backend/classes/clients.class.php";
$clients = new Clients();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once __DIR__ . "/includes/requirement.php" ?>
  <title>Dashboard</title>
</head>

<body>

  <?php require_once "./includes/sidebar.php" ?>

  <main class="md:pl-[300px] pl-8 py-8 pr-8 bg-gray-100 h-screen w-full">

    <section class="p-6 bg-white shadow rounded-lg">
      <h1 class="text-2xl font-medium">Clients</h1>
      <p class="max-w-lg text-zinc-600 text-sm mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vitae
        deleniti
        illo
        culpa aliquid
        eius soluta beatae
        expedita qui veritatis rem!
      </p>

      <div class="mb-8 flex flex-col sm:flex-row items-start gap-2 sm:items-center justify-between">
        <div class="flex items-center gap-2">
          <input type="text" class="py-1.5 px-4 border rounded-lg" placeholder="Search items here..">

          <button
            class="flex gap-2 items-center py-2 px-4 text-sm bg-zinc-900 text-white rounded-lg w-full text-start font-medium">
            <i data-lucide="search" class="h-5 w-5"></i>
            Search
          </button>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th class="px-6 py-3">Client</th>
              <th class="px-6 py-3">Model Booked</th>
              <th class="px-6 py-3">Address</th>
              <th class="px-6 py-3">Contact</th>
              <th class="px-6 py-3">Payment Status</th>
              <th class="px-6 py-3">Unit Price</th>
              <th class="px-6 py-3">Payment Method</th>
              <th class="px-6 py-3">Downpayment</th>
              <th class="px-6 py-3">Monthly Payment</th>
              <th class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($clients->getAllClients() as $client):
              extract($client) ?>
              <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4"><?= $name ?></td>
                <td class="px-6 py-4"><?= $model ?></td>
                <td class="px-6 py-4">
                  <p><?= $address ?></p>
                </td>
                <td class="px-6 py-4">
                <p><?= $phone ?></p>
                </td>
                <td class="px-6 py-4">
                  <form action="/drive-ease/backend/api/update-booking-status.php" method="POST">
                    <input type="hidden" name="booking_id" value="<?= $booking_id ?>">
                    <select name="payment_status" class="h-9 w-32 py-1.5 px-4 border rounded-lg bg-zinc-100"
                      onchange="this.form.submit()">
                      <option value="Complete" <?= $payment_status === 'Complete' ? 'selected' : '' ?>>Complete</option>
                      <option value="Paid" <?= $payment_status === 'Paid' ? 'selected' : '' ?>>Paid</option>
                      <option value="Pending" <?= $payment_status === 'Pending' ? 'selected' : '' ?>>Pending
                      </option>
                      <option value="Failed" <?= $payment_status === 'Failed' ? 'selected' : '' ?>>Failed</option>
                      <option value="Refunded" <?= $payment_status === 'Refunded' ? 'selected' : '' ?>>Refunded
                      </option>
                    </select>
                  </form>
                </td>
                <td class="px-6 py-4">₱<?= number_format($price) ?></td>
                <td class="px-6 py-4"><?= $payment_method ?></td>
                <td class="px-6 py-4">₱<?= number_format((float)$downpayment) ?></td>
                <td class="px-6 py-4">₱<?= number_format($monthly_payment) ?> x <?= $installment_months ?> months</td>
                <td class="px-6 py-4">
                  <form action="/drive-ease/backend/api/delete-booking.php" method="POST">
                    <input type="hidden" name="booking_id" value="<?= $booking_id ?>">

                    <div class="flex gap-2 mt-2">
                      <button type="submit" class="px-3 py-1.5 text-white bg-red-600 rounded-md hover:bg-red-700">
                        Delete
                      </button>
                    </div>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
  <script>
    lucide.createIcons();

    const modal = document.getElementById("modal");

    modal.classList.add("hidden")

    function showModal() {
      modal.classList.remove("hidden")
    }

    function hideModal() {
      const input = document.getElementById('car_id').value = '';
      modal.classList.add("hidden")
    }

    async function getItem(id) {
      fetch('/drive-ease/backend/api/get-car.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your backend
        },
        body: new URLSearchParams({
          car_id: id,
        })
      })
        .then(response => response.json())
        .then(data => {
          console.log('JSON response:', data);
          const car = data?.[0];
          if (!car) return;

          const input = document.getElementById('car_id').value = id;
          Object.entries(car).forEach(([key, value]) => {
            const input = document.getElementById(key);
            if (input) {
              input.value = value;
            }
          });

          showModal()
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }
  </script>
  <script>
    // Search table
    document.querySelector('input[type="text"]').addEventListener('input', function () {
      const searchTerm = this.value.toLowerCase();
      const rows = document.querySelectorAll('table tbody tr');

      rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        let matchFound = false;

        cells.forEach(cell => {
          if (cell.textContent.toLowerCase().includes(searchTerm)) {
            matchFound = true;
          }
        });

        row.style.display = matchFound ? '' : 'none';
      });
    });
  </script>

  <script>
    document.getElementById('dropzone-file').addEventListener('change', function (event) {
      const file = event.target.files[0];

      if (file) {
        const reader = new FileReader();

        reader.onloadend = function () {
          const base64String = reader.result.split(',')[1]; // Extract base64 string

          const mimeType = file.type;

          const dataUrlPrefix = `data:${mimeType};base64,`;
          const base64WithPrefix = dataUrlPrefix + base64String;

          document.getElementById('car_img').value = base64WithPrefix;
        };

        reader.readAsDataURL(file); // Convert the file to base64 format
      }
    });

  </script>

</body>

</html>