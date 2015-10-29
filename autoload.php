<?php

function autoloadConfig($className) {
    $filename = "config/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}
function autoloadModel($className) {
    $filename = "model/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

function autoloadController($className) {
    $filename = "controller/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}

function autoloadCore($className) {
    $filename = "core/" . strtolower($className) . ".php";
    if (is_readable($filename)) {
        require_once $filename;
    }
}


spl_autoload_register("autoloadConfig");
spl_autoload_register("autoloadModel");
spl_autoload_register("autoloadController");
spl_autoload_register("autoloadCore");
