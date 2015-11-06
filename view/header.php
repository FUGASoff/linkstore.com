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
                <li><a href="/link/show_all">All Links</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php
            global $ISADMIN;
            if ($ISADMIN){echo'<li><a href="/user/admin">User list</a></li>';}
            if (isset($_SESSION['uid'])){
                echo'
                    <li><a href="/link/add">Add link</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">User<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="/link/show_my">My Links</a></li>
                            <li><a href="/user/modify/'.$_SESSION['user_Id'].'">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="" class="logout2" id="logout2">Log Out</a></li>

                        </ul>
                    </li>';
            }
            else {
                echo '
                    <li><a href="/user/login">Sign In</a></li>
                    <li><a href="/user/signup">Sign up</a></li>';
             } ?>
                <script type="text/javascript">
                    $('.logout2').click(function(){
                        $.get('/user/logout/',function(data){
                            location.reload();
                        });
                    });
                </script>
            </ul>
        </div>
    </nav>
<hr>
