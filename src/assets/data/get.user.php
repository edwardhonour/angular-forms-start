<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS');
header('Content-type: application/json');

?>
{
    "id"    : "cfaad35d-07a3-4447-a6c3-d8c3d54fd5df",
    "name"  : "User Not Found",
    "email" : "nouser@nuaxess.org",
    "avatar": "assets/images/avatars/brian-hughes.jpg",
    "status": "online"
}
