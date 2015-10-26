<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
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
            <a class="navbar-brand" href="/index/">LinkStore</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/link/show_all">All Links</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php
            if (isset($_SESSION['uid'])){
                echo'
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Username<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/link/show_my">My Links</a></li>
                            <li><a href="/user/modyf">Settings</a></li>
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

=======
    <title>Test</title>
    <link rel="stylesheet" href="default.css">
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">

</head>
<body>
<div id="header">
    <br>
    <a href="/index">Index</a>
    <a href="/user/login">Login</a>
    <a href="/user/signup">Register</a>
    <a href="/user/logout">Exit</a>
</div>
<div id="content"></div>
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
<hr>
