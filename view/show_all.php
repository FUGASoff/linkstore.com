<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 15.10.15
 * Time: 16:22
 */

echo'<h1>All links</h1>';
echo'<table class="table table-striped">
    <tr><th>Title</th><th>Link</th><th>Descripton</th></tr>';
$link_ar = $this->required_data;
foreach ($link_ar as $value){
        echo'<tr><th>'.$value['link_name'].'</th><th>'.$value['link_address'].'</th><th>'.$value['link_description'].'</th></tr>';
    }
echo'</table>
 <ul class="pager">
  <li class="previous"><a href="#">Previous</a></li>
  <li class="next"><a href="#">Next</a></li>
</ul>';
