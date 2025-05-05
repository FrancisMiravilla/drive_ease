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

    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <div class="flex h-screen w-full items-center justify-center">
      <main class="pl-8 py-8 pr-8 h-screen w-full flex items-center justify-center">
        <section class="p-6 bg-white shadow rounded-lg max-w-3xl">
          <h1 class="text-2xl font-medium mb-2">Contact Us</h1>
          <p class="text-zinc-600 text-sm mb-6">Send us your inquiries or feedback using the form below. This is a
            one-way
            communication channel.</p>

          <form action="/drive-ease/backend/api/send-inquiry.php" method="POST" class="grid gap-4">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="name" class="text-sm">First Name</label>
                <input type="text" name="first_name" id="first_name" required
                  class="mt-1 w-full px-4 py-2 border rounded-lg bg-zinc-100" />
              </div>

              <div>
                <label for="name" class="text-sm">Last Name</label>
                <input type="text" name="last_name" id="last_name" required
                  class="mt-1 w-full px-4 py-2 border rounded-lg bg-zinc-100" />
              </div>
            </div>

            <div>
              <label for="email" class="text-sm">Email</label>
              <input type="email" name="email" id="email" required
                class="mt-1 w-full px-4 py-2 border rounded-lg bg-zinc-100" />
            </div>

            <div>
              <label for="subject" class="text-sm">Subject</label>
              <input type="text" name="subject" id="subject" required
                class="mt-1 w-full px-4 py-2 border rounded-lg bg-zinc-100" />
            </div>

            <div>
              <label for="message" class="text-sm">Message</label>
              <textarea name="message" id="message" rows="5" required
                class="mt-1 w-full px-4 py-2 border rounded-lg bg-zinc-100"></textarea>
            </div>

            <div class="flex justify-end">
              <button type="submit"
                class="py-2.5 px-8 w-full bg-orange-600 text-white rounded-full text-sm w-fit cursor-pointer">
                Send Message
              </button>
            </div>
          </form>
        </section>
      </main>
    </div>

  </main>
</body>

</html>