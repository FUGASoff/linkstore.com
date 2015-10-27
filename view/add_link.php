<?php

echo'
<div class="input-group">
<h2>Add new link</h2>
  <form action="/link/add" method="post">
    <input type="hidden" name="user" value="'.$_SESSION['uid'].'">
    <label>Link</label><input required type="text" name="link" class="form-control" placeholder="www.exemple.com"><br>
    <label>Description</label><input required type="text" name="description" class="form-control" placeholder="Adout link"><br>
    <label>Title</label><input required type="text" name="name" class="form-control" placeholder="Link name"><br>
    <label>Type</label><br>
      <input type="radio" name="type" value="0" > Public<br>
      <input type="radio" name="type" value="1"> Private <br>
    <label></label><input type="submit" class="btn btn-success" value="Add Link">
  </form>
</div>';
