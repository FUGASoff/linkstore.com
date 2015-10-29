<?php
require_once 'config/database.php';
require_once 'autoload.php';
$model = new model_user();
$model->CronDelete();