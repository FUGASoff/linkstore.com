<?php
<<<<<<< HEAD
//    error_reporting(E_ALL);
  //  ini_set('display_errors', TRUE);
    //ini_set('display_startup_errors', TRUE);
=======
>>>>>>> f1e5d19b93c13a54aca5b9e9dcb38724149ba621
    require 'core/model.php';
    require 'core/controller.php';
    require 'core/view.php';
    require 'model/model_user.php';
    require 'model/model_link.php';
    require 'boot.php';
    require 'config/database.php';
    session_start();
    $app = new boot();