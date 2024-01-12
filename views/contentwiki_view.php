<?php 
        $id = $_SESSION['id'];
        $ID = $_GET['id'];
        $wiki = Wiki::getArticleById($ID);
?>

<div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
  <div class="w-full items-center mx-auto max-w-screen-lg">
    <div class="group grid w-full grid-cols-2">
      <div class="pl-16 relative flex items-end flex-col before:block before:absolute before:h-1/6 before:w-4 before:bg-blue-500 before:bottom-0 before:left-0 before:rounded-lg  before:transition-all group-hover:before:bg-orange-300 overflow-hidden">
        <a class="font-bold text-sm flex mt-2 mb-8 items-center text-black gap-2" href="">
          <span>MORE ABOUT US</span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
        </a>
        <div class="rounded-xl overflow-hidden">
          <img src="assets/image/<?= $wiki['file'] ?>" alt="">
        </div>
      </div>
      <div>
        <div class="pl-12">
          <h3 class="mb-4 font-semibold text-xl text-black"><?= $wiki['title'] ?></h3>
          <h3 class="mb-4 font-semibold text-xl text-black"><?= $wiki['title'] ?></h3>
          <p class="mb-4 font-semibold text text-black"><?= date('F j, Y', strtotime($wiki['create_at'])) ?></p>
          <p class="peer mb-6 text-black"><?= $wiki['content'] ?></p>
        </div>
      </div>
    </div>
  </div>
</div>