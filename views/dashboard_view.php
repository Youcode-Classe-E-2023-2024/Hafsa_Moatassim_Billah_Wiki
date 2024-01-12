<?php
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     header("location: index.php?page=home");
//     exit(); 
// }

// $adminData = User::getAdmin();

$id = new User($_SESSION['id']);
if($id->role !== 'admin'){
    header('location: index.php?page=home');
}

?>

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @media (max-width: 768px) {
            .flex-wrap {
                display: flex;
                flex-wrap: wrap;
            }
            .section-small {
                width: 50%;
            }
        }
    </style>
</head>
<body style="background-color: while;">
<div class="flex flex-col h-screen bg-gray-100">
    <div class="flex-1 flex">
        <div class="p-2 bg-white w-60 flex flex-col hidden md:flex" id="sideNav">
            <nav>
            <?php
                $id = $_SESSION['id'];
                $Admins = User::getAdmin($id);
                        
            foreach ($Admins as $Admin) {?>
                <div class="flex rounded-b-3xl bg-white dark:bg-gray-700 space-y-5 flex-col items-center py-7 text-gray-500">
                    <img class="h-28 w-28 rounded-full" src="assets/image/<?= $Admin['file'] ?>" alt="User">
                        <span class="text-h1 font-semibold"><?= $Admin['firstname'] . ' ' . $Admin['lastname'] ?> </span>
                </div>
            <?php }?>

                <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white" 
                href="index.php?page=home">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
                <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white" 
                href="index.php?page=wiki">
                    <i class="fas fa-users mr-2"></i>Wikies
                </a>
                <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white" 
                href="index.php?page=addwiki">
                    <i class="fas fa-file-alt mr-2"></i>Add Wiki
                </a>
                <a class="block text-gray-500 py-2.5 px-4 my-4 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white" 
                href="index.php?page=about">
                    <i class="fas fa-store mr-2"></i>About
                </a>
                <a class="block text-gray-500 py-2.5 px-4 my-4 rounded">
                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-green-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  Add Tag
                </button>
                </a>
                
                <a class="block text-gray-500 py-2.5 px-4 my-4 rounded">
                <button data-modal-target="crud-modal-2" data-modal-toggle="crud-modal-2" class="block text-white bg-blue-400 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                  Add Category
                </button>
                </a>
            </nav>

            <a name="logout" class="block text-gray-500 py-2.5 px-4 my-2 rounded transition duration-200 hover:bg-gradient-to-r hover:from-cyan-400 hover:to-cyan-300 hover:text-white mt-auto" 
            href="#">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </a>
        </div>

     <!-- *************************************METRICS****************************************** -->

        <div class="flex-1 p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-2 p-2">
            
                    <div class="bg-white p-4 rounded-md">
                        <h2 class="text-gray-950 text-lg font-semibold pb-1">Users</h2>
                        <div class="my1-"></div> 
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px  mb-6"></div> 
                        <div class="chart-container" style="position: relative; height:150px; width:100%">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-md">
                        <h2 class="text-gray-950 text-lg font-semibold pb-1">Articles</h2>
                        <div class="my-1"></div> 
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                        <div class="chart-container" style="position: relative; height:150px; width:100%">
                            <canvas id="commercesChart"></canvas>
                        </div>
                    </div>

     <!-- *************************************DISPLAY USERS****************************************** -->

                <div class="bg-white p-4 rounded-md">
                    <h2 class="text-gray-950 text-lg font-semibold pb-4">Users</h2>
                    <div class="my-1"></div> 
                    <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-sm leading-normal text-gray-600">
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">ID</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">Image</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">Name</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">Email</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">OP</th>
                            </tr>
                        </thead>

                        <?php
                            $id = $_SESSION['id'];
                            $users = User::getAll($id);
                            
                        foreach ($users as $user) {?>
                        <tbody>
                            <tr class="hover:bg-grey-lighter text-gray-700 ">
                                <td class="py-2 px-4 border-b border-grey-light"><?= $user['id'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><img src="assets/image/<?= $user['file'] ?>"  class="rounded-full h-10 w-10"></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $user['firstname'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $user['email'] ?></td>
                                <td> <button  name ="delete" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-red-400 border-red-500 text-white">
                                      <a href="index.php?page=delete&delete_id=<?= $user['id'] ?>">Delete</a>
                                     </button>     
                            </td>
                                
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>        
                </div>

     <!-- *************************************DISPLAY ARTICLES****************************************** -->

                <div class="bg-white p-4 rounded-md mt-4">
                            <h2 class="text-gray-950 text-lg font-semibold pb-4">Articles</h2>
                            <div class="my-1"></div> 
                            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-sm leading-normal text-gray-700">
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">ID</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">Title</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">Created By</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">Create Date</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">Op</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $id = $_SESSION['id'];
                                $wiki = Wiki::getTheLatestWiki($id);
                                // dd($wiki);
                                foreach ($wiki as $article) {?>

                            <tr class="hover:bg-grey-lighter text-gray-700">
                                <td class="py-2 px-4 border-b border-grey-light"><?= $article['id'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $article['title'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $article['firstname'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $article['create_at'] ?></td>
                                <td> 
                                    <button id="deleteButton" name="deleteButton" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-red-400 border-red-500 text-white">
                                    <a href="index.php?page=delete&softdelete_id=<?= $article['id'] ?>">SD</a>
                                    </button>
                                    
                                </td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>

     <!-- *************************************DISPLAY TAGS****************************************** -->

                    <div class="bg-white p-4 rounded-md mt-4">
                            <h2 class="text-gray-950 text-lg font-semibold pb-4">Tags</h2>
                            <div class="my-1"></div> 
                            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-sm leading-normal text-gray-700">
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">NAME</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">OPERATION</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $id = $_SESSION['id'];
                                $tags = Tags::getAllTags($id);
                                foreach ($tags as $tag) {?>
                        
                            <tr class="hover:bg-grey-lighter text-gray-700">
                                <td class="py-2 px-4 border-b border-grey-light"><?= $tag['name'] ?></td>

                                <td> 
                                    
                                    <button id="deleteButton" name="deleteButton" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-green-400 border-green-500 text-white">
                                    <a>UPDATE</a>  
                                    </button>
                                    <button id="deleteButton" name="deleteButton" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-red-400 border-red-500 text-white">
                                    <a href="index.php?page=delete&tagdelete_id=<?= $tag['id'] ?>">DELETE</a> 
                                    </button>
                                    
                                </td>

                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>

                    
<!-- *************************************DISPLAY CATEGORY****************************************** -->

                <div class="bg-white p-4 rounded-md mt-4">
                            <h2 class="text-gray-950 text-lg font-semibold pb-4">Category</h2>
                            <div class="my-1"></div> 
                            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-sm leading-normal text-gray-700">
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">NAME</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-left">OPERATION</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $id = $_SESSION['id'];
                                $cats = Category::getAllCats();
                                foreach ($cats as $cat) {?>
                        
                            <tr class="hover:bg-grey-lighter text-gray-700">
                                <td class="py-2 px-4 border-b border-grey-light"><?= $cat['name'] ?></td>
                                <td> 
                                    
                                    <button id="deleteButtonCat" name="deleteButton" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-green-400 border-green-500 text-white 
                                    data-article-id=<?= $cat['id'] ?>">
                                    UPDATE 
                                    </button>
                                    <button id="deleteButtonCat" name="deleteButton" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-red-400 border-red-500 text-white">
                                    <a href="index.php?page=delete&catdelete_id=<?= $cat['id'] ?>">DELETE</a> 
                                    </button>
                                    
                                </td>

                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>


                </div>
            </div>
        </div>
    </div>
</div>


<!-- ************************CREAT NEW TAG************************ -->

<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Tag
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form class="p-4 md:p-5" action="index.php?page=dashboard" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tag Name</label>
                        <input type="text" name="tagName" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Tag name" required="">
                    </div>
                </div>
                <button type="submit" name="tagSubmit" class="text-white inline-flex items-center bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new Tag
                </button>
            </form>
        </div>
    </div>
</div> 

<!-- ************************CREAT NEW CAT************************ -->

<div id="crud-modal-2" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Category
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <form class="p-4 md:p-5" action="index.php?page=dashboard" method="post">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
                        <input type="text" name="namee" id="namee" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type Category name" required="">
                    </div>
                </div>
                <button type="submit" name="submite" class="text-white inline-flex items-center bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    Add new Cat
                </button>
            </form>
        </div>
    </div>
</div> 

<script>
    var usersChart = new Chart(document.getElementById('usersChart'), {
        type: 'doughnut',
        data: {
            labels: ['Guests', 'Authors'],
            datasets: [{
                data: [30, 65],
                backgroundColor: ['#D46F4D', '#8B8B8D'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom' 
            }
        }
    });

    var commercesChart = new Chart(document.getElementById('commercesChart'), {
        type: 'doughnut',
        data: {
            labels: ['Medcine', 'Cooking','Gaming','Literature'],
            datasets: [{
                data: [25, 25,20,30],
                backgroundColor: ['#F9968B', '#8B8B8D', '#76CDCD','#F27438'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom' 
            }
        }
    });

    const menuBtn = document.getElementById('menuBtn');
    const sideNav = document.getElementById('sideNav');

    menuBtn.addEventListener('click', () => {
        sideNav.classList.toggle('hidden'); 
    });


    // ******************************************************

</script>
</body>
</html>