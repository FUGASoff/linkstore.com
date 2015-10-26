<?php
<<<<<<< HEAD

if (isset($_SESSION['uid'])) {
  echo '<div class="alert alert-info">You already loged in <a href="/index">Back to main page</a></div>';
  header("Refresh:3; http://linkstore.com/");
}
else {echo '
<div class="input-group">
  <h1>Login</h1>
    <form action="/user/login" method="post">
      <label>Login</label><input required type="text" name="login" class="form-control" placeholder="Username"><br>
      <label>Password</label><input required type="password" name="password" class="form-control" placeholder="Password"><br>
      <br><input type="submit" class="btn btn-success" value="Log In">
    </form>
</div>';}
=======
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.10.15
 * Time: 14:44
 */
require 'header.php';
echo'<h1>Login</h1>
<form action="/user/login/" method="post">
  <label>Login</label><input type="text" name="login"><br>
  <label>Password</label><input type="text" name="password"><br>
  <label></label><input type="submit" value="Log In">
</form>';
require 'footer.php';
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
