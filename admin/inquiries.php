<?php

require_once __DIR__ . "/../backend/classes/inquiries.class.php";
$inquiries = new Inquiries();
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
      <h1 class="text-2xl font-medium">Inquiries</h1>
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
              <th class="px-6 py-3 w-[300px] ">First Name</th>
              <th class="px-6 py-3">Last Name</th>
              <th class="px-6 py-3">Email</th>
              <th class="px-6 py-3">Subject</th>
              <th class="px-6 py-3">Message</th>
              <th class="px-6 py-3">Created</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($inquiries->getAllInquiries() as $inquiry):
              extract($inquiry) ?>
              <tr class="bg-white border-b border-gray-200">
                <td class="px-6 py-4">
                  <?= $first_name ?>
                </td>
                <td class="px-6 py-4">
                  <?= $last_name ?>
                </td>
                <td class="px-6 py-4">
                  <?= $email ?>
                </td>
                <td class="px-6 py-4">
                  <?= $subject ?>
                </td>
                <td class="px-6 py-4">
                  <?= $message ?>
                </td>
                <td class="px-6 py-4">
                  <?= $created_at ?>
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