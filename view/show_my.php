<?php
echo'<h1>My links</h1>';
echo'<table class="table table-striped">
    <tr><th>Title</th><th>Link</th><th>Descripton</th><th></th><th></th></tr>';
$link_ar = $this->required_data;
$number_of_pages = $this->number_of_pages;
$number_of_pages=round($number_of_pages);
foreach ($link_ar as $value){
    echo'<tr>
            <th>'.$value['link_name'].'</th>
            <th>'.$value['link_address'].'</th>
            <th>'.$value['link_description'].'</th>
            <th>
            <form action="/link/edit?linkid='.$value['link_id'].'" method="post">
            <input type="hidden" name="link_name" value="'.$value['link_name'].'">
            <input type="hidden" name="link_address" value="'.$value['link_address'].'">
            <input type="hidden" name="link_description" value="'.$value['link_description'].'">
             <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-pencil"></span></button></form></th class="col-md-11"><th>
             <button class="btn btn-default btn-sm " ><span class="glyphicon glyphicon-trash"></span></button>
            </th>
        </tr>';
    }
echo'</table>
 <ul class="pager">';
if(isset($_GET['page'])) {
    if (($_GET['page'] - 1) >= 0) echo '<li class="previous"><a href="/link/show_all?page=' . ($_GET['page'] - 1) . '">Previous</a></li>';
    if (($_GET['page'] + 1) < $number_of_pages)
        echo '<li class="next"><a href="/link/show_all?page=' . ($_GET['page'] + 1) . '">Next</a></li>';
}
echo'</ul>';
