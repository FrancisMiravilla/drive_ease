<?php

require_once __DIR__ . "/../backend/classes/cars.class.php";
$cars = new Cars();

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
      <h1 class="text-2xl font-medium">Registered Cars</h1>
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

        <button onclick="showModal()"
          class="flex gap-2 items-center py-2 px-4 text-sm bg-zinc-900 text-white rounded-lg text-start font-medium">
          <i data-lucide="circle-plus" class="h-5 w-5"></i>
          Add Car
        </button>
      </div>
      <div class="overflow-x-auto">
        <table class="table-auto w-full text-sm text-left rtl:text-right text-gray-500">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
              <th class="px-6 py-3 w-[300px] ">Model</th>
              <th class="px-6 py-3">Price</th>
              <th class="px-6 py-3">Year</th>
              <th class="px-6 py-3">Condition</th>
              <th class="px-6 py-3">Mileage</th>
              <th class="px-6 py-3">Engine</th>
              <th class="px-6 py-3">Transmission</th>
              <th class="px-6 py-3">Fuel Eff.</th>
              <th class="px-6 py-3">Seating Cap.</th>
              <th class="px-6 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($cars->getAllCars() as $car):?>
             <input type="hidden" value="$car['car_id']" name="car_id">
              <tr class="bg-white border-b border-gray-200">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                  <div class="flex items-start gap-2 truncate whitespace-nowrap overflow-hidden">
                    <img src="<?= $car['car_img']?>" class="rounded h-16 w-24 object-scale-down border rounded-xl" srcset="">
                    <div class="flex flex-col">
                      <h1 class="mt-4 font-medium"><?= $car['model'] ?></h1>
                      <p class="text-xs text-zinc-500 font-medium"><?= $car['category'] ?></p>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4">
                  ₱ <?= number_format($car['price']) ?>

                </td>
                <td class="px-6 py-4">
                  <?= $car['year'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $car['car_condition'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $car['mileage'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $car['engine']?>
                </td>
                <td class="px-6 py-4">
                  <?= $car['transmission'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $car['fuel_efficiency'] ?>
                </td>
                <td class="px-6 py-4">
                  <?= $car['seating_capacity'] ?>
                </td>
                <td class="px-6 py-4">
            <div class="flex items-center gap-2">
                <button onclick="getItem('<?= $car['car_id'] ?>')"
                    class="flex gap-2 items-center p-2 text-sm w-fit hover:bg-green-400 text-zinc-900 rounded-lg text-start font-medium">
                    <i data-lucide="edit" class="h-4 w-4"></i>
                </button>
                
                <form action="/drive-ease/backend/api/delete-car.php" method="POST" class="inline">
                    <input type="hidden" name="car_id" value="<?= $car['car_id'] ?>">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this car?')" 
                        class="flex gap-2 items-center p-2 text-sm w-fit bg-red-500 text-white rounded-lg text-start font-medium">
                        <i data-lucide="trash-2" class="h-4 w-4"></i>
                    </button>
                </form>
            </div>
        </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>


    <div id="modal" class="fixed top-0 left-0 h-screen w-full bg-black/80">
      <div class="flex h-full items-center justify-center">
        <form action="../backend/api/upsert-car.php" method="POST"
          class="h-[900px] overflow-scroll max-w-2xl w-full bg-white border rounded-xl p-6">
          <h1 class="text-lg font-medium">Car Details</h1>
          <p class="text-sm text-zinc-600 w-44 mb-4">Lorem ipsum dolor sit, amet consectetur adipisicing elit.</p>

          <div class="grid grid-cols-2 gap-4">
            <input type="hidden" name="car_id" id="car_id">
            <input type="hidden" name="car_img" id="car_img">

            <div class="grid gap-1 5">
              <label for="model" class="text-sm">Model Name</label>
              <input type="text" name="model" id="model" class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
            </div>

            <div class="grid gap-1 5">
              <label for="year" class="text-sm">Year</label>
              <select name="year" id="year" class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
                <option value="2005">2005</option>
                <option value="2004">2004</option>
                <option value="2003">2003</option>
                <option value="2002">2002</option>
                <option value="2001">2001</option>
                <option value="2000">2000</option>
                <option value="1999">1999</option>
                <option value="1998">1998</option>
                <option value="1997">1997</option>
                <option value="1996">1996</option>
                <option value="1995">1995</option>
                <option value="1994">1994</option>
                <option value="1993">1993</option>
                <option value="1992">1992</option>
                <option value="1991">1991</option>
                <option value="1990">1990</option>
                <option value="1989">1989</option>
                <option value="1988">1988</option>
                <option value="1987">1987</option>
                <option value="1986">1986</option>
                <option value="1985">1985</option>
                <option value="1984">1984</option>
                <option value="1983">1983</option>
                <option value="1982">1982</option>
                <option value="1981">1981</option>
                <option value="1980">1980</option>
              </select>
            </div>

            <div class="grid gap-1 5">
              <label for="category" class="text-sm">Category</label>
              <select name="category" id="category" class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
                <option value="Sport">Sport</option>
                <option value="SUV">Suv</option>
                <option value="Van">Van</option>
                <option value="Sedan">Sedan</option>
              </select>
            </div>

            <div class="grid gap-1 5">
              <label for="car_condition" class="text-sm">Car Condition</label>
              <select name="car_condition" id="car_condition"
                class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
                <option value="BRAND_NEW">BRAND_NEW</option>
                <option value="SECOND_HAND">SECOND_HAND</option>
              </select>
            </div>

            <div class="grid gap-1 5">
              <label for="mileage" class="text-sm">Mileage</label>
              <input type="text" name="mileage" id="mileage"
                class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
            </div>

            <div class="grid gap-1 5">
              <label for="engine" class="text-sm">Engine</label>
              <input type="text" name="engine" id="engine" class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
            </div>

            <div class="grid gap-1 5">
              <label for="transmission" class="text-sm">Transmission</label>
              <input type="text" name="transmission" id="transmission"
                class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
            </div>

            <div class="grid gap-1 5">
              <label for="price" class="text-sm">Price</label>
              <input type="number" name="price" id="price" class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
            </div>

            <div class="grid gap-1 5">
              <label for="fuel_efficiency" class="text-sm">Fuel Efficiency (L/<span
                  class="font-medium">km</span>)</label>
              <input type="text" name="fuel_efficiency" id="fuel_efficiency"
                class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
            </div>

            <div class="grid gap-1 5">
              <label for="seating_capacity" class="text-sm">Seating Capacity</label>
              <input type="number" name="seating_capacity" id="seating_capacity"
                class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
            </div>

            <div class="col-span-2 grid gap-1 5">
              <label for="description" class="text-sm">Description</label>
              <textarea type="number" name="description" id="description"
                class="h-24 w-full py-1.5 px-4 border rounded-lg bg-zinc-100"></textarea>
            </div>


            <div class="col-span-2 flex items-center justify-center w-full">
              <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                  <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                  </svg>
                  <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to
                      upload</span> or drag and drop</p>
                  <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" />
              </label>
            </div>
          </div>

          <div class="mt-4 flex items-center gap-4 justify-end">
            <button type="button" onclick="hideModal()"
              class="flex gap-2 items-center py-2 px-4 text-sm bg-zinc-200 rounded-lg text-start font-medium">
              Cancel
            </button>
            <button
              class="flex gap-2 items-center py-2 px-4 text-sm bg-zinc-900 text-white rounded-lg text-start font-medium">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>

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
    try {
        const response = await fetch('/drive-ease/backend/api/get-car.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                car_id: id,
            })
        });

        const data = await response.json();
        console.log('Car data:', data);

        if (!data?.[0]) {
            console.error('No car data received');
            return;
        }

        const car = data[0];

        // Set car_id first
        document.getElementById('car_id').value = id;

        // Update form fields
        const fields = [
            'model', 'category', 'price', 'description', 'year',
            'car_condition', 'mileage', 'engine', 'transmission',
            'fuel_efficiency', 'seating_capacity', 'car_img'
        ];

        fields.forEach(field => {
            const input = document.getElementById(field);
            if (input && car[field] !== undefined) {
                if (input.tagName === 'SELECT') {
                    // For select elements, update selected option
                    Array.from(input.options).forEach(option => {
                        option.selected = option.value === car[field];
                    });
                } else {
                    input.value = car[field];
                }
            }
        });

        // Update submit button text
        const submitBtn = document.querySelector('form button[type="submit"]');
        if (submitBtn) {
            submitBtn.textContent = 'Update Car';
        }

        showModal();
    } catch (error) {
        console.error('Error fetching car data:', error);
    }
}

// Reset form when hiding modal
function hideModal() {
    document.getElementById('car_id').value = '';
    
    // Reset all form fields
    const form = document.querySelector('form');
    if (form) {
        form.reset();
    }
    
    // Reset submit button text
    const submitBtn = document.querySelector('form button[type="submit"]');
    if (submitBtn) {
        submitBtn.textContent = 'Create Car';
    }

    modal.classList.add("hidden");
}

function showModal() {
    modal.classList.remove("hidden");
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