<?php
$link_ar = $this->required_data;
if (isset($view_set['linkid'])) {
    echo '<table class="table table-striped">
            <tr><th>Title</th><th>Link</th><th>Descripton</th><th>Type</th></tr><tr><th>';
    if (isset($link_ar['link_name'])) {
        echo $link_ar['link_name'];
        echo '</th><th>';
    }
    if (isset($link_ar['link_address'])) {
        echo $link_ar['link_address'];
        echo '</th><th>';
    }
    if (isset($link_ar['link_description'])) {
        echo $link_ar['link_description'];
        echo '</th><th>';
    }
    if (isset($link_ar['type'])) {
        if ($link_ar['type']==0)
        echo 'public';
        else echo 'private';
        echo '</th>';
    }
    echo '</tr></table>
<div class="input-group">
<h2>Edit link</h2>
  <form action="/link/edit/' . $view_set['linkid'] . '" method="post">
    <input type="hidden" name="user" value="' . $_SESSION['uid'] . '">
    <label>Link</label><input type="text" name="new_link" class="form-control" placeholder="'.$link_ar['link_address'].'"><br>
    <label>Title</label><input type="text" name="new_name" class="form-control" placeholder="'.$link_ar['link_name'].'"><br>
    <label>Description</label><input type="text" name="new_description" class="form-control" placeholder="'.$link_ar['link_description'].'"><br>
    <label>Type</label><br>
      <input type="radio" name="new_type" value="0"> Public<br>
      <input type="radio" name="new_type" value="1"> Private <br>
    <label></label><input type="submit" class="btn btn-success" value="Edit">
  </form>
</div>';

}