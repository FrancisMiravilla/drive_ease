<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

?>
<header class="fixed bg-white z-50 top-0 left-0 h-16 w-full border-b">
  <div class="sm:px-14 flex items-center justify-between h-full container mx-auto">
    <a href="./index.php" class="font-medium text-3xl"><span class="text-orange-600 font-bold">Drive</span>Ease</a>
    <div class="flex items-center gap-4">
      <a href="index.php" class="py-2 px-4 text-sm hover:bg-zinc-200 rounded-lg">
        Home
      </a>
      <a href="cars.php" class="py-2 px-4 text-sm hover:bg-zinc-200 rounded-lg">
        Cars
      </a>
      <a href="about-us.php" class="py-2 px-4 text-sm hover:bg-zinc-200 rounded-lg">
        About Us
      </a>
      <a href="contact-us.php" class="py-2 px-4 text-sm hover:bg-zinc-200 rounded-lg">
        Contact Us
      </a>

      <?php if (isset($_SESSION["user_id"])): ?>
        <span class="text-sm text-gray-700">Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="./backend/api/logout.php" class="py-2 px-4 text-sm hover:bg-zinc-200 rounded-lg">
          Logout
        </a>
      <?php else: ?>
        <a href="./sign-in.php"
          class="py-2.5 px-8 w-36 bg-orange-600 text-white rounded-full text-sm w-fit cursor-pointer">
          Sign In
        </a>
      <?php endif; ?>

    </div>
  </div>
</header>