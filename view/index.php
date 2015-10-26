<<<<<<< HEAD

=======
<?php require 'header.php'; ?>
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
<?php
if(isset($_SESSION['uid'])){
    echo '
    <form action="/index" method="post"><input type="submit" name="add_link" value="Add new link" /></form>
    <form action="/link/show_all" method="post"><input type="submit" name="showall" value="Show all links" /></form>
    <form action="/link/show_my" method="post"><input type="submit" name="showmy" value="Show my links" /></form>
    ';
}
else {
    echo '
<<<<<<< HEAD
    <form action="/user/login" method="post"><input type="submit" name="login" value="Sign In" /></form>
    <form action="/user/signup" method="post"><input type="submit" name="signup" value="Sign Up" /></form>
    ';
}
=======
    <form action="user/login" method="post"><input type="submit" name="login" value="Sign In" /></form>
    <form action="user/signup" method="post"><input type="submit" name="signup" value="Sign Up" /></form>
    ';
}
require 'footer.php'; ?>
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
