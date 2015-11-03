<?php

if (isset($_SESSION['uid'])) {
  header("Refresh:3; http://linkstore.com/");
}
else
{
  echo '
<div class="input-group">
  <h1>Login</h1>
    <form action="/user/login" method="post">
      <label>Login</label><input required type="text" name="login" class="form-control" placeholder="Username"><br>
      <label>Password</label><input required type="password" name="password" class="form-control" placeholder="Password"><br>
      <br><input type="submit" class="btn btn-success" value="Log In">
    </form>
</div>';
}