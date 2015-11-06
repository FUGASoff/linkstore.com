<?php
echo'<h1>My links</h1>';
echo'<table class="table table-striped">
    <tr><th>Title</th><th>Link</th><th>Descripton</th><th>Type</th><th></th><th></th></tr>';
$link_ar = $this->required_data;
$number_of_pages = $this->number_of_pages;
$number_of_pages=round($number_of_pages);
foreach ($link_ar as $value){
    $la=$value['link_id'];
    $ln=$value['link_address'];
    if($value['type']==0) {$type='Public';}
    else{$type='Private';}
    echo'<tr>
            <th>'.$value['link_name'].'</th>
            <th>'.$value['link_address'].'</th>
            <th>'.$value['link_description'].'</th>
            <th>'.$type.'</th>
            <th>
            <form action="/link/edit/'.$la.'" method="post">
             <button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-pencil"></span></button></form></th class="col-md-11"><th>

             <button class="btn btn-default btn-sm " data-toggle="modal" data-target="#myModal'.$la.'"><span class="glyphicon glyphicon-trash"></span></button>
            </th>
        </tr>
        <div class="modal fade" id="myModal'.$la.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete link</h4>
              </div>
              <div class="modal-body">
                You realy want to delete '.$ln.'?
              </div>
              <div class="modal-footer">
                <form action="/link/delete/'.$la.'" method="post">
                <input type="submit" class="btn btn-danger" value="Delete"></form>
              </div>
            </div>
          </div>
</div>';

    }
echo'</table>
 <ul class="pager">';
if(isset($view_set['page'])) {
    $page=$view_set['page'];
    if (($page - 1) >= 0) echo '<li class="previous"><a href="/link/show_my?page='.($page - 1) . '">Previous</a></li>';
    if (($page + 1) < $number_of_pages)
        echo '<li class="next"><a href="/link/show_my?page=' . ($page + 1) . '">Next</a></li>';
}
echo'</ul>';
