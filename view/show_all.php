<?php
echo'<h1>All links</h1>';
echo'<table class="table table-striped">
    <tr><th>Title</th><th>Link</th><th>Descripton</th></tr>';
$link_ar = $this->required_data;
$number_of_pages = $this->number_of_pages;
$number_of_pages=round($number_of_pages);
foreach ($link_ar as $value){
    echo'<tr><th>'.$value['link_name'].'</th>
             <th>'.$value['link_address'].'</th>
             <th>'.$value['link_description'].'</th>
             </tr>';
    }
echo'</table>


 <ul class="pager">';
if(isset($view_set['page'])) {
    $page=$view_set['page'];
    if (($page - 1) >= 0) echo '<li class="previous"><a href="/link/show_all?page=' . ($page - 1) . '">Previous</a></li>';
    if (($page + 1) < $number_of_pages)
        echo '<li class="next"><a href="/link/show_all?page=' . ($page + 1) . '">Next</a></li>';
}
echo'</ul>';
