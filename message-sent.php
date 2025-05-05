<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once __DIR__ . "/includes/requirement.php" ?>
  <title>Thank You | DriveEase</title>
</head>

<body>
  <main class="overflow-x-hidden">

    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <div class="flex h-screen w-full items-center justify-center px-4">
      <div class="h-fit max-w-sm w-full rounded-lg p-4 text-center">
        <h1 class="font-medium text-3xl mb-2"><span class="text-orange-600 font-bold">Drive</span>Ease</h1>
        <p class="text-zinc-500 mb-6">Booking Confirmation</p>

        <div class="rounded bg-green-50 border border-green-500 text-green-800 py-3 px-4 mb-4">
          Your message was successfully submitted! 🎉
        </div>

        <p class="text-sm text-zinc-600 mb-6">
          Thank you for choosing DriveEase. We will contact you shortly.
        </p>

        <a href="/drive-ease/index.php"
          class="inline-block py-2.5 px-8 bg-orange-600 text-white rounded-full text-sm hover:bg-orange-700 transition">
          Go to Home
        </a>
      </div>
    </div>

  </main>
</body>

</html>