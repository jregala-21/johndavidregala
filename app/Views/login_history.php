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
    

<head>
    <title>Login History</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 40px;
        }
        .table-responsive {
            max-height: 600px;
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1 class="text-center mb-4">Login / Logout History</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Information</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Log counts:</th>
                                        <th>Login Time:</th>
                                        <th>Logout Time:</th>
                                        <th>IP Address:</th>
                                        <th>User Agent:</th>
                                        <th>Action:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($loginHistory as $login) : ?>
                                        <tr>
                                            <td><?= $login['id'] ?></td>
                                            <td><?= date('M j, Y h:i A', strtotime($login['login_time'])) ?></td>
                                            <td><?= date('M j, Y h:i A', strtotime($login['logout_time'])) ?></td>
                                            <td><?= $login['ip_address'] ?></td>
                                            <td><?= substr($login['user_agent'], 0, 50) . '...' ?></td>
                                            <td>
                                                <a href="<?= base_url('login-history/delete/' . $login['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>



<?php

/*
<h1>Login History</h1>

<style>
    .table-container {
        overflow-x: auto;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .table th {
        background-color: #f0f0f0;
    }

    .table td {
        background-color: #fff;
    }

    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<div class="table-container">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col">User ID</th>
                <th scope="col">Login Time</th>
                <th scope="col">Logout Time</th>
                <th scope="col">IP Address</th>
                <th scope="col">User Agent</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($loginHistory as $login) : ?>
                <tr>
                    <td><?= $login['user_id'] ?></td>
                    <td><?= date('M j, Y h:i A', strtotime($login['login_time'])) ?></td>
                    <td><?= date('M j, Y h:i A', strtotime($login['logout_time'])) ?></td>
                    <td><?= $login['ip_address'] ?></td>
                    <td><?= substr($login['user_agent'], 0, 50) . '...' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


*/

?>