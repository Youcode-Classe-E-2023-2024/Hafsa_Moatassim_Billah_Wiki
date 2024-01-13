
<!-- component -->
  <header>
    <nav class="p-6">
          <div class="flex items-center max-w-md mx-auto bg-white rounded-lg " x-data="{ search: '' }">
              <div class="w-full">
                  <input type="search" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none"
                      placeholder="search" x-model="search">
              </div>
          </div>
    </nav>

    <!-- Section banner -->
    <div class="container mx-auto bg-gray-400 h-96 rounded-md flex items-center" style="background-image: url('https://images.pexels.com/photos/19770764/pexels-photo-19770764/free-photo-of-paysage-soleil-couchant-voler-rochers.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
      <div class="sm:ml-20 text-gray-50 text-center sm:text-left">
        <h1 class="text-5xl font-bold mb-4">
          Explore Our Wikies
        </h1>
        <p class="text-lg inline-block sm:block">The largest online community to share wikies.</p>
        <button class="mt-8 px-4 py-2 bg-gray-400 rounded"><a href="indes.php?page=addwiki">Add Wiki</a></button>
      </div>
    </div>

  </header>
  <main class="py-16 container mx-auto px-6 md:px-0">

<section>
  <h1 class="text-xl font-bold text-gray-950 mb-10">Explore Our Wikies</h1>
  <div class="grid sm:grid-cols-3 gap-4 grid-cols-2">
    <?php 
      $id = $_SESSION['id'];
      $wiki = Wiki::getAllarticles();
      foreach($wiki as $article){ ?>

        <div>
          <div class="bg-gray-300 h-44">
            <img src="assets/image/<?= $article['file'] ?>" alt="<?= $article['title'] ?>" class="w-full h-full object-cover" />
          </div>
          <h3 class="text-lg font-bold text-gray-800 mt-2"><?= $article['title'] ?></h3>
          <p class="font-semibold text-gray-500 mt-2"><?= $article['firstname'] ?></p>
          <p class="font-regular text-gray-500 mt-2"><?= date('F j, Y', strtotime($article['create_at'])) ?></p>
        </div>

    <?php }?>
  </div>
  <hr class="w-40 my-14 border-4 rounded-md sm:mx-0 mx-auto" />
</section>
