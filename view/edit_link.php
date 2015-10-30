<?php
$link_ar = $this->required_data;
echo'<table class="table table-striped">
            <tr><th>Title</th><th>Link</th><th>Descripton</th></tr>
            <tr>
            <th>'.$link_ar['link_name'].'</th>
            <th>'.$link_ar['link_address'].'</th>
            <th>'.$link_ar['link_description'].'</th>
        </tr></table>
<div class="input-group">
<h2>Edit link</h2>
  <form action="/link/edit?linkid='.$_GET['link_id'].'" method="post">
    <input type="hidden" name="user" value="'.$_SESSION['uid'].'">
    <label>Link</label><input type="text" name="new_link" class="form-control" placeholder="www.exemple.com"><br>
    <label>Description</label><input type="text" name="new_description" class="form-control" placeholder="Adout link"><br>
    <label>Title</label><input type="text" name="new_name" class="form-control" placeholder="Link name"><br>
    <label>Type</label><br>
      <input type="radio" name="new_type" value="0" > Public<br>
      <input type="radio" name="new_type" value="1"> Private <br>
    <label></label><input type="submit" class="btn btn-success" value="Edit">
  </form>
</div>';
