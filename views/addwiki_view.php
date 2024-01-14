<?php
if(!isset($_SESSION['id'])){
    header("location:index.php?page=login");
}
?>
<div class='flex items-center justify-center min-h-screen from-cyan-100 via-red-200 to-green-200 bg-gradient-to-br'>

<form action="index.php?page=addwiki" method="post" class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl" enctype="multipart/form-data">
    <div class="heading text-center font-bold text-2xl text-gray-800">New Wiki</div>
        <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"  placeholder="Title" name="title" type="text">
        <textarea class="description bg-gray-100 sec p-3 h-30 border border-gray-300 outline-none"  name="content" placeholder="Describe everything about this post here"></textarea>

    <div class="m-3">  
            <select class="z-2 mt-1 w-full rounded bg-blue-10 ring-1 ring-gray-300" name="tags[]" required multiple>
              <option value="" disabled selected class="bg-blue-12">Select Tags</option>
              <?php 
              $tags = Tags::getAllTags();
              foreach($tags as $tag) {
              ?>
              <option value="<?= $tag['id']?>"><?= $tag['name']?></option>
            <?php } ?>
            </select>
    </div>

    <div class="m-3">
            <select class="z-2 mt-1 w-full rounded bg-blue-10 ring-1 ring-gray-300"  name="category" required>
              <option value="" disabled selected>Select a category</option>
              <?php 
              $cats = Category::getAllCats();
              foreach($cats as $cat) {
              ?>
              <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
              <?php } ?>
            </select>

    </div>
        <div class="items-center justify-center font-sans">
          <label for="dropzone-file" class="mx-auto cursor-pointer flex w-full max-w-lg flex-col items-center rounded-xl border-2 border-dashed border-blue-400 bg-white p-6 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
            <h2 class="mt-4 text-xl font-medium text-gray-700 tracking-wide">Wiki File</h2>
            <p class="mt-2 text-gray-500 tracking-wide">Upload or darg & drop your file SVG, PNG, JPG or GIF. </p>
            <input id="dropzone-file" type="file" name="img" class="hidden" />
          </section>
        </div>

        <div class="buttons flex mt-5">
          <button class="btn border border-gray-300 p-1 px-4 font-semibold cursor-pointer text-gray-500 ml-auto" name="cancel">Cancel</button>
          <button class="btn border border-indigo-500 p-1 px-4 font-semibold cursor-pointer text-gray-200 ml-2 bg-blue-700" name="submit">Post</button>
        </div>
</form>
</div>

<?php
$userId = $_SESSION['id'];
$userArticles = Wiki::getUserArticles($userId);

if (!empty($userArticles)) {
  foreach ($userArticles as $article) { 
    echo'
            <div class="flex-auto block py-8 pt-6 px-9">
              <div class="overflow-x-auto">
                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                  <thead class="align-bottom">
                    <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                      <th class="pb-3 text-start min-w-[175px]">Image</th>
                      <th class="pb-3 text-end min-w-[100px]">Title</th>
                      <th class="pb-3 text-end min-w-[100px]">Created at</th>
                      <th class="pb-3 text-end min-w-[100px]">Operation</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="border-b border-dashed last:border-b-0">
                      <td class="p-3 pl-0">
                        <div class="flex items-center">
                          <div class="relative inline-block shrink-0 rounded-2xl me-3">
                            <img src="assets/image/'.$article['file'].'" class="w-[50px] h-[50px] inline-block shrink-0 rounded-2xl" alt="">
                          </div>
                        </div>
                      </td>
                      <td class="p-3 pr-12 text-end">
                        <span class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-warning bg-warning-light rounded-lg">'.$article['title'].'</span>
                      </td>
                      <td class="p-3 pr-12 text-end">
                        <span class="text-center align-baseline inline-flex px-4 py-3 mr-auto items-center font-semibold text-[.95rem] leading-none text-warning bg-warning-light rounded-lg">'.$article['create_at'].'</span>
                       </td>
                      <td class="p-3 pr-12 text-end">
                        <button  name ="delete" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-red-400 border-red-500 text-white">
                          <a href="index.php?page=delete&softdelete_id='.$article['id'].'">Delete</a>
                        </button>
                        <button  name ="delete" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-green-400 border-green-500 text-white">
                          <a href="index.php?page=delete&update_id='.$article['id'].'">Update</a>
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>';

  }
}