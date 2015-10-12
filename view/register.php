<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 12.10.15
 * Time: 12:23
 */
require 'header.php';
echo'<h1>Registration</h1>
<form action="register" method="post">
  <label>Login</label><input type="text" name="login"><br>
  <label>E-mail</label><input type="text" name="email"><br>
  <label>Password</label><input type="text" name="password"><br>
  <label></label><input type="submit">
</form>';
require 'footer.php';