<?php
session_start();
if (isset($_SESSION["user_id"])) {
  header('Location: index.php');
  exit;
}
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

    <?php require_once __DIR__ . "/includes/navbar.php" ?>

    <div class="flex h-screen w-full items-center justify-center">
      <form action="./backend/api/login.php" method="POST" class="h-fit max-w-sm w-full rounded-lg p-4">
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
          <button class="py-2.5 px-8 w-full bg-orange-600 text-white rounded-full text-sm w-fit cursor-pointer">
            Sign In
          </button>
        </div>

        <?php if (isset($_GET["result"]) && $_GET["result"] == "success"): ?>
          <div class="rounded text-green-800 w-full bg-green-50 border-green-500 mt-2 py-2.5 px-4">
            Successfuly logged in!
          </div>
        <?php elseif (isset($_GET["result"]) && $_GET["result"] == "invalid"): ?>
          <div class="rounded text-red-800 w-full bg-red-50 border-red-500 mt-2 py-2.5 px-4">
            Invalid login credentials!
          </div>
        <?php endif; ?>

        <p class="text-sm my-2">
          Don't have an account yet?
          <a href="./sign-up.php" class="hover:text-orange-600 hover:font-medium">Sign up</a>
        </p>
      </form>
    </div>

  </main>
</body>

</html>