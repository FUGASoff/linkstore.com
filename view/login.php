<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.10.15
 * Time: 14:44
 */
require 'header.php';
if (isset($_SESSION['uid'])) {
  echo '<div class="alert alert-info">You already loged in <a href="/index/">Back to main page</a></div>';
  header("Refresh:3; http://linkstore.com/");
}
else {echo '
<div class="input-group">
  <h1>Login</h1>
    <form action="/user/login/" method="post">
      <label>Login</label><input type="text" name="login" class="form-control" placeholder="Username"><br>
      <label>Password</label><input type="password" name="password" class="form-control" placeholder="Password"><br>
      <br><input type="submit" class="btn btn-success" value="Log In">
    </form>
</div>';}
require 'footer.php';