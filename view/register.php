<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 12.10.15
 * Time: 12:23
 */
require 'header.php';
echo'<h1>Registration</h1>
<form action="/user/signup/" method="post">
  <label>Login</label><input type="text" name="login"><br>
  <label>E-mail</label><input type="text" name="email"><br>
  <label>Password</label><input type="text" name="password"><br>
  <input type="submit" value="Register me">
</form>';
require 'footer.php';