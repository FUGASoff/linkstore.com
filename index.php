<?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    require_once 'config/database.php';
    require_once 'autoload.php';
    require_once 'boot.php';
    session_start();
    if (isset($_SESSION['uid'])) {
        $model = new model_user();
        $test=$model->is_adm($_SESSION['uid']);
        if($test)$ISADMIN=true;
            else $ISADMIN=false;
    }
    else
        $ISADMIN=false;
    $app = new boot();