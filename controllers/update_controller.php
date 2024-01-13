<?php

if (isset($_GET['tag_id'])) {
    $tagId = $_GET['tag_id'];

    $tag = Tags::getTagById($ID); 

    if (!$tag) {
        echo "Tag not found.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['new_tag_name']; 

        $updated = Tags::updateTag($tagId, $newName);

        if ($updated) {
            header('location: index.php?page=dashboard');
            exit();
        } else {
            echo "Error updating tag.";
        }
    }
?>

    
<div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
  <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
    <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
      <form class="px-5 py-7" method="post">
        <label class="font-semibold text-sm text-gray-600 pb-1 block">New Tag Name</label>
        <input type="text" name="new_tag_name" value="<?= $tag['name'] ?>" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />
        <button type="submit" name="submit" class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
        <span class="inline-block mr-2">Change the Name</span>   
        </button>
      </form>
    </div> 
  </div>
</div>


<?php
} else {
    echo "Invalid request.";
}
?>

<!-- ************************************************** -->
<?php

if (isset($_GET['cat_id'])) {
    $catId = $_GET['cat_id'];

    $cat = Category::getCatById($catId); 

    if (!$cat) {
        echo "Tag not found.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newName = $_POST['new_cat_name']; 

        $updated = Category::updateCat($catId, $newName);

        if ($updated) {
            header('location: index.php?page=dashboard');
            exit();
        } else {
            echo "Error updating tag.";
        }
    }
?>

    
<div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
  <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
    <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
      <form class="px-5 py-7" method="post">
        <label class="font-semibold text-sm text-gray-600 pb-1 block">New Cat Name</label>
        <input type="text" name="new_cat_name" value="<?= $cat['name'] ?>" class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" required />
        <button type="submit" name="submit" class="transition duration-200 bg-blue-500 hover:bg-blue-600 focus:bg-blue-700 focus:shadow-sm focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
        <span class="inline-block mr-2">Change the Name</span>   
        </button>
      </form>
    </div> 
  </div>
</div>


<?php
} else {
    echo "Invalid request.";
}
?>

