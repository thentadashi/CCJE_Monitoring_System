<?php
session_start();
?>
<?php
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
    <title>coming soon</title>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php' ?>
    <div id="layoutSidenav">
        <?php include 'nav.php' ?>
        <div id="layoutSidenav_content">
            <div id="layoutAuthentication">
                <div id="layoutAuthentication_content">
                    <main>
                        <div class="container-fluid px-4">
                            <div class="card bg-white mb-2">
                                <div class="card-body">
                                    <div class="align-self-center">
                                        <h1 class="mt-4">Coming Soon</h1>
                                        <ol class="breadcrumb mb-4">
                                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                            <li class="breadcrumb-item active">Tables</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <?php include('alert_message.php'); ?>

                            <div class="card mb-4">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
            <?php include 'footer.php' ?>
        </div>
    </div>
    <?php include 'script.php' ?>
</body>
</html>
