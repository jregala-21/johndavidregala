<!DOCTYPE html>
<html lang="en">

<style>
@tailwind base;
@tailwind components;
@tailwind utilities;

</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Only keeping necessary custom styles, using Tailwind classes for colors */
        :root {
            --header-height: 4rem;
            --sidebar-width: 240px;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-down {
            animation: slideDown 0.5s ease-out;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }
    </style>

<script>
    var startTime = new Date().getTime();
    var intervalId = setInterval(function() {
        var currentTime = new Date().getTime();
        var elapsedTime = currentTime - startTime;
        var days = Math.floor(elapsedTime / 86400000);
        var hours = Math.floor((elapsedTime % 86400000) / 3600000);
        var minutes = Math.floor((elapsedTime % 3600000) / 60000);
        var seconds = Math.floor((elapsedTime % 60000) / 1000);
        document.getElementById("running-time").innerHTML = days + ":" + hours + ":" + minutes + ":" + seconds;
        document.getElementById("timezone").innerHTML = Intl.DateTimeFormat().resolvedOptions().timeZone;
    }, 1000);

</script>

</head>
<body class="bg-indigo-50 min-h-screen overflow-x-hidden">
    <div class="overlay fixed inset-0 bg-indigo-900/50 z-40 hidden opacity-0 transition-opacity duration-300"></div>
    
    <header class="fixed w-full bg-white text-indigo-800 z-50 shadow-lg animate-slide-down">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between h-16">
            <button class="mobile-menu-button p-2 lg:hidden">
                <span class="material-icons-outlined text-2xl">menu</span>
            </button>
            <div class="text-xl font-bold text-blue-900">
                Admin<span class="text-indigo-800">Panel</span>
            </div>
            <div class="flex items-center space-x-2">
            <a href="<?= base_url('profile') ?>">
         <img class="w-10 h-10 rounded-full transition-transform duration-300 hover:scale-110 object-cover" 
             src="https://i.pinimg.com/564x/de/0f/3d/de0f3d06d2c6dbf29a888cf78e4c0323.jpg"
             alt="Profile">
    </a>
</div>
        </div>
    </header>

    <div class="pt-16 max-w-7xl mx-auto flex">
        <aside class="sidebar fixed lg:static w-[240px] bg-indigo-50 h-[calc(100vh-4rem)] lg:h-auto transform -translate-x-full lg:translate-x-0 transition-transform duration-300 z-45 overflow-y-auto p-4">
            <div class="bg-white rounded-xl shadow-lg mb-6 p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                <a href="<?php echo base_url('dashboard'); ?>" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                    <span class="material-icons-outlined mr-2">dashboard</span>
                    Home
                    <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                </a>
                <a href="<?= base_url('logout'); ?>" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                    <span class="material-icons-outlined mr-2">power_settings_new</span>
                    Log out
                    <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-4 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                
            <a href="profile.php" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                    <span class="material-icons-outlined mr-2">face</span>
                    Profile
                    <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                </a>
                <a href="<?= site_url('edit-profile') ?>" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                    <span class="material-icons-outlined mr-2">face</span>
                    Edit Profile
                    <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                </a>
                <a href="<?= site_url('login-history') ?>" class="flex items-center text-gray-600 hover:text-indigo-800 py-4 transition-all duration-300 hover:translate-x-1">
                    <span class="material-icons-outlined mr-2">settings</span>
                    View Login History
                    <span class="material-icons-outlined ml-auto">keyboard_arrow_right</span>
                </a>
                
            </div>
        </aside>

        <main class="flex-1 p-4">
            <div class="flex flex-col lg:flex-row gap-4 mb-6">
                <div class="flex-1 bg-indigo-100 border border-indigo-200 rounded-xl p-6 animate-fade-in">
                    <h2 class="text-4xl md:text-5xl text-blue-900">
                        Welcome <br><strong><?php echo $dashboards['name']; ?></strong>
                    </h2>
                    <span class="inline-block mt-8 px-8 py-2 rounded-full text-xl font-bold text-white bg-indigo-800">
                        <p id="running-time">00:00:00</p>
                    </span>
                </div>

                <div class="flex-1 bg-blue-100 border border-blue-200 rounded-xl p-6 animate-fade-in">
                    <h2 class="text-4xl md:text-5xl text-blue-900">
                        Profile <br><strong>Page</strong>
                    </h2>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row gap-4 mb-6">
                    <div class="flex-1 bg-indigo-100 border border-indigo-200 rounded-xl p-6 animate-fade-in">
                        <h5 class="text-4xl md:text-5xl text-blue-900">User Information:</h5>
                        <br>
                        <table class="table table-striped">
                            <tr>
                                <td class="text-4xl md:text-3xl text-blue-900">ID:</td>
                                <td class="text-4xl md:text-3xl text-blue-900"><?= $dashboards['id'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-4xl md:text-3xl text-blue-900">Name:</td>
                                <td class="text-4xl md:text-3xl text-blue-900">&nbsp;&nbsp;<?= $dashboards['name'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-4xl md:text-3xl text-blue-900">Email:</td>
                                <td class="text-4xl md:text-3xl text-blue-900">&nbsp;&nbsp;<?= $dashboards['email'] ?></td>
                            </tr>
                        </table>
                    </div>
            </div>
        </main>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');

        function toggleMobileMenu() {
            sidebar.classList.toggle('translate-x-0');
            overlay.classList.toggle('hidden');
            setTimeout(() => overlay.classList.toggle('opacity-0'), 0);
            document.body.style.overflow = sidebar.classList.contains('translate-x-0') ? 'hidden' : '';
        }

        mobileMenuButton.addEventListener('click', toggleMobileMenu);
        overlay.addEventListener('click', toggleMobileMenu);

        // Close mobile menu on window resize if open
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && sidebar.classList.contains('translate-x-0')) {
                toggleMobileMenu();
            }
        });

        // Notification animation
        const notificationIcon = document.querySelector('.material-icons-outlined:nth-child(2)');
        setInterval(() => {
            notificationIcon.classList.add('scale-110');
            setTimeout(() => notificationIcon.classList.remove('scale-110'), 200);
        }, 5000);
    </script>
</body>
</html>

<?php

/*

<!-- views/dashboard.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Dashboard</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">User Information</h5>
                        <table class="table table-striped">
                            <tr>
                                <td>ID:</td>
                                <td><?= $dashboards['id'] ?></td>
                            </tr>
                            <tr>
                                <td>Name:</td>
                                <td><?= $dashboards['name'] ?></td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td><?= $dashboards['email'] ?></td>
                            </tr>
                        </table>
                        <a href="<?= site_url('edit-profile') ?>" class="btn btn-primary">Edit Profile</a>
                        <a href="<?= site_url('login-history') ?>" class="btn btn-primary">Login History</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>

*/

?>