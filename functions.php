<?php
require_once 'classes/ConnexionMessages.php';
function redirect($url){
    header("Location:$url");
    die();
}



