
<header>
<nav class="p-6">
    <div class="flex items-center max-w-md mx-auto bg-white rounded-lg" x-data="{ search: '' }">
        <div class="w-full flex items-center">
            <div class="flex-1 relative">
                <input type="search" id="search-input" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none"
                    placeholder="search" x-model="search">
                <div id="container" class="flex items-center justify-center">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="ml-4">
                <select name="select-type" id="select-type"
                    class="px-2 py-1 text-gray-800 rounded-full focus:outline-none">
                    <option value="Tags">Tags</option>
                    <option value="Category">Category</option>
                    <option value="Title">Title</option>
                </select>
            </div>
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
      // $id = $_SESSION['id'];
      $wiki = Wiki::getAllarticles();
      foreach($wiki as $article){ ?>

        <div>
          <div class="h-44">
            <a href="index.php?page=contentwiki&id=<?= $article['id'] ?>"><img src="assets/image/<?= $article['file'] ?>" alt="<?= $article['title'] ?>" class="w-full h-full object-cover" /></a>
          </div>
          <h3 class="text-lg font-bold text-gray-800 mt-2"><?= $article['title'] ?></h3>
          <p class="font-semibold text-gray-500 mt-2"><?= $article['firstname'] ?></p>
          <p class="font-regular text-gray-500 mt-2 mb-4"><?= date('F j, Y', strtotime($article['create_at'])) ?></p>
        </div>

    <?php }?>
  </div>
  <hr class="w-40 my-14 border-4 rounded-md sm:mx-0 mx-auto" />
</section>


  <script>
      const searchInput = document.getElementById("search-input");
      // const resultsContainer = document.getElementById("search-results-container");
      const searchType = document.getElementById("select-type");



      searchInput.addEventListener("input", () => {
          console.log(searchInput.value);
          console.log(searchType.value);

          // if (searchInput.value !== "") {
              getSearchedResults(searchInput.value, searchType.value);
          // } else
          //     resultsContainer.innerHTML = "";
      })
      const container = document.getElementById("container");
            container.innerHTML = "";
            data.forEach((res) => {
            container.innerHTML += resultTemplate(res);
            });

      function getSearchedResults(search,searchType) {
        const req = new XMLHttpRequest();
        container.innerHTML = "";

        req.open("POST", "index.php?page=searchbar", true);
        req.onload = () =>{
            if(req.readyState === XMLHttpRequest.DONE){
                if(req.status === 200){
                    let data = JSON.parse(req.response)

                    data.forEach(res=>{ 
                      console.log(res)
                      container.innerHTML += ` <div class="searched-item dark:bg-gray-800 my-6 dark:text-gray-50">
          <div class="container grid grid-cols-12 mx-auto dark:bg-gray-900">
              <div class="bg-no-repeat bg-cover dark:bg-gray-700 col-span-full lg:col-span-4"></div>
              <div class="flex flex-col p-6 col-span-full row-span-full lg:col-span-8 lg:p-10">
                  <h1 class="text-3xl font-semibold">${res.title}</h1>
              </div>
          </div>
        </div>`;
        container.innerHTML += resultTemplate(res);
                         })
                }
            }
        }
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        req.send(`search_title=${search}&search_tag=${searchType}`)
      }
  </script>