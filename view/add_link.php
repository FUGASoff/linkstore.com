<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 14.10.15
 * Time: 16:17
 */
require 'header.php';
echo'<h2>Add new link</h2>
<form action="/link/add/" method="post">
  <input type="hidden" name="user" value="'.$_COOKIE['username'].'">
  <label>Link</label><input type="text" name="link"><br>
  <label>Description</label><input type="text" name="description"><br>
  <label>Title</label><input type="text" name="name"><br>
  <label>Type</label><br>
    <input type="radio" name="type" value="0"> Public<br>
    <input type="radio" name="type" value="1"> Private <br>
  <label></label><input type="submit">
</form>';
require 'footer.php';