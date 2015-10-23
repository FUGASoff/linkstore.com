<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 12.10.15
 * Time: 12:23
 */
require 'header.php';
echo'
<div class="input-group">
  <h1>Registration</h1>
  <form action="/user/signup/" method="post">
    <label>Login</label><input type="text" name="login" class="form-control" placeholder="Username"><br>
    <label>E-mail</label><input type="email" name="email" class="form-control" placeholder="E-mail"><br>
    <label>Password</label><input type="password" name="password" class="form-control" placeholder="password"><br>
    <input type="submit" class="btn btn-success" value="Sign up">
  </form>
</div>';
require 'footer.php';