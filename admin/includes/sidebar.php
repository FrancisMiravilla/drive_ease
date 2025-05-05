<?php
$currentPage = basename($_SERVER['PHP_SELF']);

$sidebarLinks = [
  [
    'href' => './cars.php',
    'icon' => 'car',
    'label' => 'Registered Cars'
  ],
  [
    'href' => './clients.php',
    'icon' => 'contact',
    'label' => 'Clients'
  ],
  [
    'href' => './inquiries.php',
    'icon' => 'mail-question',
    'label' => 'Inquiries'
  ]
];
?>

<aside class="hidden sm:block fixed top-0 left-0 w-64 h-screen bg-white border-r">
  <h1 class="font-medium text-3xl text-center mt-4"><span class="text-orange-600 font-bold">Drive</span>Ease</h1>

  <ul class="px-4 mt-12 space-y-2">
    <?php foreach ($sidebarLinks as $link):
      $isActive = $currentPage === basename($link['href']);
      ?>
      <li>
        <a href="<?= $link['href'] ?>"
          class="flex gap-2 items-center py-2 px-4 text-sm hover:bg-zinc-100 rounded-lg w-full text-start text-zinc-600 font-medium <?= $isActive ? 'bg-zinc-200' : '' ?>">
          <i data-lucide="<?= $link['icon'] ?>" class="h-5 w-5"></i>
          <?= $link['label'] ?>
        </a>
      </li>
    <?php endforeach; ?>

    <li>
      <a href="/drive-ease/backend/api/logout.php"
        class="flex gap-2 items-center py-2 px-4 text-sm hover:bg-zinc-100 rounded-lg w-full text-start text-zinc-600 font-medium">
        <i data-lucide="log-out" class="h-5 w-5"></i>
        Logout
      </a>
    </li>
  </ul>
</aside>