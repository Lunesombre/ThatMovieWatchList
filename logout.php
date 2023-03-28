<?php
require_once __DIR__.'/functions/redirect.php';
session_start();
$_SESSION = [];
session_destroy();
redirect('index.php');
