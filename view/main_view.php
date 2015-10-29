<?php require_once 'header.php';
$view_set=$this->view_set;
if (isset($view_set['msg_code'])) {
    if ($view_set['msg_code'] != 0) {
        echo '<div class="page-header">';
        $msg = $view_set['msg'];
        if ($view_set['msg_code'] == 1) {
            echo '<h1>Seccess!=)</h1>
        <div class="alert alert-success">';
            echo $msg;
            echo '</div></div>';
        }
        if ($view_set['msg_code'] == 2) {
            echo '<h1>Atention!=|</h1>
        <div class="alert alert-info">';
            echo $msg;
            echo '</div></div>';
        }
        if ($view_set['msg_code'] == 3) {
            echo '<h1>We have a problem!=(</h1><div class="alert alert-danger">';
            echo $msg;
            echo '</div></div>';
        }
        $view_set['msg_code'] = 0;
    }
}
$file='view/' . $view_set['body_name'] . '.php';
require_once $file;
require_once 'footer.php'; ?>