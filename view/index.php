<?php require 'header.php'; ?>
<?php
if(!empty($_COOKIE['username']) AND !empty($_COOKIE['password'])){
    echo '
    <form action="/index" method="post"><input type="submit" name="add_link" value="Add new link" /></form>
    <form action="/link/showall" method="post"><input type="submit" name="showall" value="Show all links" /></form>
    <form action="/link/showmy" method="post"><input type="submit" name="showmy" value="Show my links" /></form>
    ';
}
else {
    echo '
    <form action="login" method="post"><input type="submit" name="login" value="Sign In" /></form>
    <form action="register" method="post"><input type="submit" name="register" value="Sign Up" /></form>
    ';
}
require 'footer.php'; ?>