<?php
<<<<<<< HEAD

echo'
<div class="input-group">
  <h1>Registration</h1>

  <form action="/user/signup" method="post" id="form" onsubmit="return checkform(this)">

    <label>Login</label><input required type="text" name="login" id="login" class="form-control" placeholder="Username"><br>
    <label>E-mail</label><input required type="email" name="email" class="form-control" placeholder="E-mail"><br>
    <label>Password</label><input required type="password" name="password" class="form-control" placeholder="password" id="password1"><br>
    <label>Repeat Password</label><input required type="password" name="password" class="form-control" placeholder="password" id="password2"><br>
    <div id="err_pas2" class="error"></div>
    <input type="submit" class="btn btn-success" value="Sign up">
  </form>
  <script type="text/javascript">
	function checkform(form){
	    if (document.getElementById("password1").value!=document.getElementById("password2").value) {
	        document.getElementById("err_pas2").innerHTML="You entered different passwords";
	        return false;
	    }
	    return true;
	}
    </script>
</div>';
=======
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
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
