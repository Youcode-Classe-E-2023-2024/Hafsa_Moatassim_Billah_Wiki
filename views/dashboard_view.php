<?php
// if (!$role['admin']) {
//     header("location: index.php?page=home");
// } 
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
                $id = $_SESSION['c'];
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
                        <h2 class="text-gray-500 text-lg font-semibold pb-1">Users</h2>
                        <div class="my1-"></div> 
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px  mb-6"></div> 
                        <div class="chart-container" style="position: relative; height:150px; width:100%">
                            <canvas id="usersChart"></canvas>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-md">
                        <h2 class="text-gray-500 text-lg font-semibold pb-1">Articles</h2>
                        <div class="my-1"></div> 
                        <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                        <div class="chart-container" style="position: relative; height:150px; width:100%">
                            <canvas id="commercesChart"></canvas>
                        </div>
                    </div>

     <!-- *************************************DISPLAY USERS****************************************** -->

                <div class="bg-white p-4 rounded-md">
                    <h2 class="text-gray-500 text-lg font-semibold pb-4">Users</h2>
                    <div class="my-1"></div> 
                    <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-sm leading-normal text-gray-600">
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">ID</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Image</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Name</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Email</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">OP</th>
                            </tr>
                        </thead>

                        <?php
                            $id = $_SESSION['c'];
                            $users = User::getAll($id);
                            
                        foreach ($users as $user) {?>
                        <tbody>
                            <tr class="hover:bg-grey-lighter text-gray-700 ">
                                <td class="py-2 px-4 border-b border-grey-light"><?= $user['id'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><img src="assets/image/<?= $user['file'] ?>"  class="rounded-full h-10 w-10"></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $user['firstname'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $user['email'] ?></td>
                                <td> <button  name ="delete" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-red-400 border-red-500 text-white">
                                      Delete
                                     </button>     
                            </td>
                                
                            </tr>
                        </tbody>
                        <?php }?>
                    </table>        
                </div>

     <!-- *************************************DISPLAY ARTICLES****************************************** -->

                <div class="bg-white p-4 rounded-md mt-4">
                            <h2 class="text-gray-500 text-lg font-semibold pb-4">Articles</h2>
                            <div class="my-1"></div> 
                            <div class="bg-gradient-to-r from-cyan-300 to-cyan-500 h-px mb-6"></div> 
                    <table class="w-full table-auto text-sm">
                        <thead>
                            <tr class="text-sm leading-normal text-gray-700">
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">ID</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Title</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light">Created By</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">Create Date</th>
                                <th class="py-2 px-4 bg-grey-lightest font-bold uppercase text-sm text-grey-light border-b border-grey-light text-right">Op</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $id = $_SESSION['c'];
                                $wiki = User::getTheLatestWiki($id);
                                foreach ($wiki as $article) {?>
                        
                            <tr class="hover:bg-grey-lighter text-gray-700">
                                <td class="py-2 px-4 border-b border-grey-light"><?= $article['id'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $article['title'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light"><?= $article['title'] ?></td>
                                <td class="py-2 px-4 border-b border-grey-light text-right"><?= $article['create_at'] ?></td>
                                <td> 
                                    <button id="deleteButton" name="deleteButton" class="rounded px-3 py-2 m-1 border-b-4 border-l-2 shadow-lg bg-red-400 border-red-500 text-white 
                                    data-article-id=<?= $article['id'] ?>">
                                     SD 
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