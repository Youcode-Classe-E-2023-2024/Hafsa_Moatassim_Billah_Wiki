

    <div class="heading text-center font-bold text-2xl m-5 text-gray-800">New Wiki</div>
    <style>
      body {background: #eef2ff !important;}
    </style>

<form action="index.php?page=addwiki" method="post" class="editor mx-auto w-10/12 flex flex-col text-gray-800 border border-gray-300 p-4 shadow-lg max-w-2xl" enctype="multipart/form-data">
        <input class="title bg-gray-100 border border-gray-300 p-2 mb-4 outline-none"  placeholder="Title" name="title" type="text">
        <textarea class="description bg-gray-100 sec p-3 h-30 border border-gray-300 outline-none"  name="content" placeholder="Describe everything about this post here"></textarea>

    <div class="m-3">
      
            <select class="z-2 mt-1 w-full rounded bg-blue-200 ring-1 ring-gray-300" name="tags[]" required multiple>
              <option value="" disabled selected class="bg-blue-100">Select Tags</option>
              <?php 
              $tags = Wiki::getTag();
              foreach($tags as $tag) {
              ?>
              <option value=""><?= $tag['name']?></option>
            <?php } ?>
            </select>
    </div>

    <div class="m-3">
            <select class="z-2 mt-1 w-full rounded bg-blue-100 ring-1 ring-gray-300"  name="category" required>
              <option value="" disabled selected>Select a category</option>
              <?php 
              $cats = Wiki::getCategory();
              foreach($cats as $cat) {
              ?>
              <option value=""><?=$cat['name']?></option>
              <?php } ?>
            </select>

    </div>
        <div class="items-center justify-center bg-gray-100 font-sans">
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