<?php

echo '
<div class="input-group">
  <h1>Send activation link again</h1>
    <form action="/user/SendAgain" method="post">
      <label>Login</label><input required type="text" name="login" class="form-control" placeholder="Username"><br>
      <label>E-mail</label><input required type="email" name="email" class="form-control" placeholder="E-mail"><br>
      <label>Password</label><input required type="password" name="password" class="form-control" placeholder="Password"><br>
      <br><input type="submit" class="btn btn-success" value="Send">
    </form>
</div>';