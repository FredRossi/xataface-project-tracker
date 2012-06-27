<?php //Main Application access point
require_once "D:\\bin\\xampp\\htdocs\\xataface/dataface-public-api.php";
df_init(__FILE__, "/xataface");
$app =& Dataface_Application::getInstance();
$app->display();
