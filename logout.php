<?php
session_start();
set_include_path($_SERVER['DOCUMENT_ROOT']);
require 'php_dependancy/config.php';

session_destroy();
header('Location: /');
?>
