<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 13.10.15
 * Time: 14:44
 */
require 'header.php';
echo'<h1>Login</h1>
<form action="login" method="post">
  <label>Login</label><input type="text" name="login"><br>
  <label>Password</label><input type="text" name="password"><br>
  <label></label><input type="submit">
</form>';
require 'footer.php';