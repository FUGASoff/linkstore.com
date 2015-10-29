<?php

echo'
<div class="input-group">
  <h1>Registration</h1>

  <form action="/user/signup" method="post" id="form" onsubmit="return checkform(this)">

    <label>Login</label><input required type="text" name="login" id="login" class="form-control" placeholder="Username"><br>
    <label>E-mail</label><input required type="email" name="email" class="form-control" placeholder="E-mail"><br>
    <label>Password</label><input required type="password" name="password" class="form-control" placeholder="password" id="password1"><br>
    <label>Confirm Password</label><input required type="password" name="password" class="form-control" placeholder="password" id="password2"><br>
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
