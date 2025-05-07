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
      <form action="./backend/api/signup.php" method="POST" class="h-fit max-w-sm w-full rounded-lg p-4" onsubmit="return validateForm()">
        <h1 class="font-medium text-center text-3xl mb-2"><span class="text-orange-600 font-bold">Drive</span>Ease
        </h1>
        <p class="text-zinc-500 text-center">Enter your login details to continue</p>

        <div class="grid gap-4 mt-12">
          <div class="grid gap-1 5">
            <label for="model" class="text-sm">Username</label>
            <input type="text" name="username" id="username"
              class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
          </div>
          <div class="grid gap-1 5">
            <label for="model" class="text-sm">Password</label>
            <input type="password" name="password" id="password"
              class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
          </div>
          <div class="grid gap-1 5">
            <label for="confirm_password" class="text-sm">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password"
              class="h-9 w-full py-1.5 px-4 border rounded-lg bg-zinc-100">
              <span id="password_error" class="text-red-500 text-sm hidden">Passwords do not match!</span>
          </div>
          <button class="py-2.5 px-8 w-full bg-orange-600 text-white rounded-full text-sm w-fit cursor-pointer">
            Create account
          </button>
        </div>

        <?php if (isset($_GET["result"]) && $_GET["result"] == "success"): ?>
          <div class="rounded text-green-800 w-full bg-green-50 border-green-500 mt-2 py-2.5 px-4">
            Successfuly created account!
          </div>
        <?php endif; ?>

        <p class="text-sm my-2">
          Already have an account?
          <a href="./sign-in.php" class="hover:text-orange-600 hover:font-medium">Sign up</a>
        </p>
      </form>
    </div>

  </main>
  <script>
function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const errorElement = document.getElementById('password_error');

    if (password !== confirmPassword) {
        errorElement.classList.remove('hidden');
        return false;
    }
    errorElement.classList.add('hidden');
    return true;
}
</script>
</body>

</html>