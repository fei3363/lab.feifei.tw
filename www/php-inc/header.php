<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.1/assets/img/favicons/favicon.ico">

    <title>Web Pentest 課程 <?php echo $titlename; ?></title>

    <!-- Custom styles for this template -->
    <link href="/php-inc/dashboard.css" rel="stylesheet">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.min.js></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js></script>
</head>

<body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">WebPentest</a>

        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="account" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
                <div class="dropdown-menu" aria-labelledby="account">

                    <?php
                    if ($_SESSION["loggedin"] == True) {
                        echo '<a class="dropdown-item" href="/account/reset-password.php">Reset Password</a>';
                        echo '<a class="dropdown-item" href="/account/logout.php">Sign out</a>';
                    } else {
                        echo '<a class="dropdown-item" href="/account/register.php">Sign up</a>';
                        echo '<a class="dropdown-item" href="/account/login.php">Sign in</a>';
                    } ?>

                </div>
            </li>
            </li>
        </ul>




    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="/practice/">
                                <span data-feather="home"></span>
                                Dashboard <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/practice/camp/">
                                <span data-feather="layers"></span>
                                資安新手村
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/practice/warm/">
                                <span data-feather="layers"></span>
                                Warm up 暖身題
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                <span data-feather="layers"></span>
                                Basic
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/practice/linux/">
                                    <span data-feather="layers"></span>
                                    Linux 指令
                                </a>
                                <a class="dropdown-item" href="/practice/basic/">
                                    <span data-feather="layers"></span>
                                    網頁 & 網路概論
                                </a>
                                <a class="dropdown-item" href="/practice/ssdlc/">
                                    <span data-feather="layers"></span>
                                    安全開發流程
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/practice/osint/">
                                <span data-feather="layers"></span>
                                OSINT & 資訊洩漏
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/practice/vulnbasic/">
                                <span data-feather="layers"></span>
                                常見網站漏洞
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/practice/vulnbasic/injection.php">
                                <span data-feather="layers"></span>
                                Injection
                            </a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                <span data-feather="layers"></span>
                                驗證 & 外洩 & 權限
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="/practice/auth/">
                                    <span data-feather="layers"></span>
                                    Broken Authentication
                                </a>
                                <a class="dropdown-item" href="/practice/sensitive/">
                                    <span data-feather="layers"></span>
                                    SenSitive Data Exposure
                                </a>
                                <a class="dropdown-item" href="/practice/access/">
                                    <span data-feather="layers"></span>
                                    Broken Access Control
                                </a>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/practice/deserialization/">
                                <span data-feather="layers"></span>
                                Insecure Deserialization
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/practice/vc/">
                                <span data-feather="layers"></span>
                                Vulnerable Components
                            </a>
                        </li>


                    </ul>



                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <br>
                <?php

                if ($challenge_type == "alert") {
                    echo '<div class="alert alert-danger" role="alert">' . $challenge_messange . '</div>';
                } elseif ($challenge_type == "success") {
                    echo '<div class="alert alert-success" role="alert">' . $challenge_messange . '</div>';
                }
                ?>