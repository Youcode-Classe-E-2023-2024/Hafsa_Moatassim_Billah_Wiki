


<div class=" bg-indigo-50">
  <header>
    <h1 class="bg-white py-4 text-center">
    <a href="#" class="text-xl font-bold text-gray-700 cursor-pointer">Discover, Learn, and Share with Wiki</h1>
    </h1>
  </header>
  <section class="min-h-screen body-font text-gray-600 ">
    <div class="container mx-auto px-5 py-10">
      <div class="-m-4 flex flex-wrap">
        
        <?php 
        $id = $_SESSION['c'];
        $wiki = User::getAllarticles($id);

        foreach($wiki as $article){ ?>

        <div class="w-full p-4 md:w-1/2 lg:w-1/4">
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
  </section>
</div>