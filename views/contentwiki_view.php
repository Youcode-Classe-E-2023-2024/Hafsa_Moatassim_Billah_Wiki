

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
          <?php 
          if(!empty($newTagsArray)){
          foreach($newTagsArray as $tag){?>
          <button
            class="middle none center mt-4 rounded-lg bg-green-500 py-2 px-2 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            data-ripple-light="true">
            <?= $tag ?>
          </button>
          <?php } }else{ ?>
            <button
            class="middle none center mr-4 rounded-lg bg-green-500 py-3 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-red-500/20 transition-all hover:shadow-lg hover:shadow-red-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            data-ripple-light="true">
            No tags
          </button>
            <?php } ?>
        </div>
      </div>
      <div>
        <div class="pl-12">
          <h3 class="mb-4 font-semibold text-xl text-black"><?= $wiki['title'] ?></h3>
          <p class="mb-4 font-semibold text text-black"><?= date('F j, Y', strtotime($wiki['create_at'])) ?></p>


          <p class="peer mt-4 mb-6 text-black"><?= $wiki['content'] ?></p>
          <!-- <a href="index.php?page=update&id=<?= $ID ?>" class="text-blue-500 hover:underline">Update Article</a>
          <a href="index.php?page=delete&id=<?= $ID ?>" class="text-red-500 hover:underline">Delete Article</a> -->
        </div>
      </div>
    </div>
  </div>
</div>
