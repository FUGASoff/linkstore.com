<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Linkstore</title>
    <script src="../bootstrap/jquery-2.1.4.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.css">
    <script src="../bootstrap/js/bootstrap.js"></script>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/index">LinkStore</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/link/show_all?page=0">All Links</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php
            if (isset($_SESSION['uid'])){
                echo'
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Username<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/link/show_my">My Links</a></li>
                            <li><a href="/user/modify">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="/user/logout">Log Out</a></li>
                        </ul>
                    </li>';
            }
            else {
                echo '
                    <li><a href="/user/login">Sign In</a></li>
                    <li><a href="/user/signup">Sign up</a></li>';
             }
            ?>
            </ul>
        </div>
    </nav>
<div id="content"></div>

<hr>
