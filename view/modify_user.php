<?php

echo'
<div class="form-group">
  <h1>Account Settings</h1>
    <h2>Change email</h2>
      <form action="/user/modify" method="post" id="emailform" class="form-horizontal" >
        <div class="form-group">
          <label class="col-sm-2 control-label">E-mail</label>
            <div class="col-sm-5">
              <input required type="email" name="email" class="col-sm-1 form-control" placeholder="E-mail">
            </div>
        </div>
          <input type="submit" class="btn btn-success" value="Change email">
      </form>

    <h2>Change password</h2>
      <form action="/user/modify" method="post" id="form" onsubmit="return checkform(this)" class="form-horizontal">
      <div class="form-group">
        <label class="col-sm-2 control-label">Old password</label>
          <div class="col-sm-5">
            <input required type="password" name="oldpass" class=" col-sm-1 form-control" placeholder="old password">
          </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-5">
            <input required type="password" name="password" class=" col-sm-1 form-control" placeholder="password" id="password1">
          </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Confirmation</label>
          <div class="col-sm-5">
            <input required type="password" name="password" class="col-sm-1 form-control" placeholder="password" id="password2">
          </div>
      </div>
        <div id="err_pas2" class="error"></div>
      </div>
        <input type="submit" class="btn btn-success" value="Change password">
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
    <h2>Remove account</h2>
    <form action="/user/delete_user" method="post" id="form_delete" class="form-horizontal">
        <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
          <div class="col-sm-5">
            <input required type="password" name="password" class=" col-sm-1 form-control" placeholder="password">
          </div>
        </div>
        <input type="submit" class="btn btn-danger" value="Delete my account">
    </form>
</div>';