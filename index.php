<?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    require 'core/model.php';
    require 'core/controller.php';
    require 'core/view.php';
    require 'model/model_user.php';
    require 'model/model_link.php';
    require 'boot.php';
    require 'config/database.php';
    session_start();
    $app = new boot();