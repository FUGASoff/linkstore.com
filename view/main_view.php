<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Linkstore</title>
        <script src="/bootstrap/jquery-2.1.4.js"></script>
        <script src="/bootstrap/js/bootstrap.js"></script>
        <link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
    </head>
    <body>

<?php
        require_once 'header.php';
        $view_set=$this->view_set;
        if (isset($view_set['msg_code'])) {
            if ($view_set['msg_code'] != 0) {
                echo '<div class="page-header">';
                $msg = $view_set['msg'];
                if ($view_set['msg_code'] == 1) {
                    echo '<div class="alert alert-success"><h2>';
                    echo $msg;
                    echo '</h2></div></div>';
                }
                if ($view_set['msg_code'] == 2) {
                    echo '<div class="alert alert-info"><h2>';
                    echo $msg;
                    echo '</h2></div></div>';
                }
                if ($view_set['msg_code'] == 3) {
                    echo '<div class="alert alert-danger"><h2>';
                    echo $msg;
                    echo '</h2></div></div>';
                }
                $view_set['msg_code'] = 0;
            }
        }
?>

        <div id="container">

<?php
            if(isset($view_set['body_name']))
            {
                $file='view/' . $view_set['body_name'] . '.php';
                require_once $file;
            }
            require_once 'footer.php';
?>
        </div>
    </body>
</html>
