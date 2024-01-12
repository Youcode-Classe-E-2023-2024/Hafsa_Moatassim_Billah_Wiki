


<div class="bg-indigo-50">
  <header>
    <h1 class="bg-white py-4 text-center">
    <!-- component -->
    <div class="relative mr-6">
      <input type="search" class="bg-purple-white shadow rounded border-0 p-3" placeholder="Search by name...">
      <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">
      </div>
    </div> 
    <!-- <a href="#" class="text-xl font-bold text-gray-700 cursor-pointer">Discover, Learn, and Share with Wiki</a> -->
    </h1>
  </header>
  <section class="min-h-screen body-font text-gray-600">
    <div class="container mx-auto px-5 py-10">
      <div class="-m-4 flex flex-wrap">
        
        <?php 
        // $id = $_SESSION['c'];
        $wiki = Wiki::getAllarticles();
        foreach($wiki as $article){ ?>

        <div class="w-1/4 p-4">
          <a href="index.php?page=contentwiki&id=<?= $article['id'] ?>" class="relative block h-48 overflow-hidden rounded">
            <img class="block h-full w-full object-cover object-center cursor-pointer" src="assets/image/<?= $article['file'] ?>" />
          </a>
          <div class="mt-4">
            <h3 class="title-font mb-1 text-xs tracking-widest text-gray-500"><?= $article['id_user'] ?></h3>
            <h2 class="title-font text-lg font-medium text-gray-900"><?= $article['title'] ?></h2>
            <p class="mt-1"><?= date('F j, Y', strtotime($article['create_at'])) ?></p>
          </div>
        </div>

        <?php }?>
  
      </div>
    </div>
  </section>
</div>



<!-- ******************* -->
<!-- component -->
<!-- <div class=" bg-indigo-50">
  Header

  <header>
    <h1 class="bg-white py-4 text-center">
    <a href="#" class="text-xl font-bold text-gray-700 cursor-pointer">BUSINESS MODEL CANVAS</h1>
    </h1>
    <nav class="mt-6">
      <ul class="flex justify-center  items-center space-x-4">
        <li><a href="#" class="text-md font-semibold text-gray-600 hover:text-gray-800">Home</a></li>
        <li><a href="#" class="text-md font-semibold text-gray-600 hover:text-gray-800">New Project</a></li>
        <li><a href="#" class="text-md font-semibold text-gray-600 hover:text-gray-800">About</a></li>
      </ul>
    </nav>
  </header>
  <section class="min-h-screen body-font text-gray-600 ">
    <div class="container mx-auto px-5 py-10">
      <div class="-m-4 flex flex-wrap">
        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
          <a class="relative block h-48 overflow-hidden rounded">
            <img alt="ecommerce" class="block h-full w-full object-cover object-center cursor-pointer" src="https://dummyimage.com/420x260" />
          </a>
          <div class="mt-4">
            <h3 class="title-font mb-1 text-xs tracking-widest text-gray-500">PROJECT</h3>
            <h2 class="title-font text-lg font-medium text-gray-900">The Catalyzer</h2>
            <p class="mt-1">01/09/2022</p>
          </div>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
          <a class="relative block h-48 overflow-hidden rounded">
            <img alt="ecommerce" class="block h-full w-full object-cover object-center cursor-pointer" src="https://dummyimage.com/421x261" />
          </a>
          <div class="mt-4">
            <h3 class="title-font mb-1 text-xs tracking-widest text-gray-500">PROJECT</h3>
            <h2 class="title-font text-lg font-medium text-gray-900">Shooting Stars</h2>
            <p class="mt-1">01/09/2022</p>
          </div>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
          <a class="relative block h-48 overflow-hidden rounded">
            <img alt="ecommerce" class="block h-full w-full object-cover object-center cursor-pointer" src="https://dummyimage.com/421x261" />
          </a>
          <div class="mt-4">
            <h3 class="title-font mb-1 text-xs tracking-widest text-gray-500">PROJECT</h3>
            <h2 class="title-font text-lg font-medium text-gray-900">Shooting Stars</h2>
            <p class="mt-1">01/09/2022</p>
          </div>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
          <a class="relative block h-48 overflow-hidden rounded">
            <img alt="ecommerce" class="block h-full w-full object-cover object-center cursor-pointer" src="https://dummyimage.com/421x261" />
          </a>
          <div class="mt-4">
            <h3 class="title-font mb-1 text-xs tracking-widest text-gray-500">PROJECT</h3>
            <h2 class="title-font text-lg font-medium text-gray-900">Shooting Stars</h2>
            <p class="mt-1">01/09/2022</p>
          </div>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
          <a class="relative block h-48 overflow-hidden rounded">
            <img alt="ecommerce" class="block h-full w-full object-cover object-center cursor-pointer" src="https://dummyimage.com/421x261" />
          </a>
          <div class="mt-4">
            <h3 class="title-font mb-1 text-xs tracking-widest text-gray-500">PROJECT</h3>
            <h2 class="title-font text-lg font-medium text-gray-900">Shooting Stars</h2>
            <p class="mt-1">01/09/2022</p>
          </div>
        </div>
        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
          <a class="relative block h-48 overflow-hidden rounded">
            <img alt="ecommerce" class="block h-full w-full object-cover object-center cursor-pointer" src="https://dummyimage.com/421x261" />
          </a>
          <div class="mt-4">
            <h3 class="title-font mb-1 text-xs tracking-widest text-gray-500">PROJECT</h3>
            <h2 class="title-font text-lg font-medium text-gray-900">Shooting Stars</h2>
            <p class="mt-1">01/09/2022</p>
          </div>
        </div>
    </div>
  </section>
   Footer 
  <footer>
    <p class="text-center  py-4 bg-white">Create By &copy; YOTHIN INTHAVYXUP</p>
  </footer>
</div> -->

