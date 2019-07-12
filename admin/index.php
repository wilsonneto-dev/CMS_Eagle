<?php

include_once '../php/config/config.php';

session_start();
BaseDAO::$sl = false;

// $route = isset($_GET['route']) ? $_GET['route'] : '';

EagleAdmin::init($_GET);
exit();
