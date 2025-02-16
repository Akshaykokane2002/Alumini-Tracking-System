<?php
session_start();
unset($_SESSION["uname"]);

unset($_SESSION["password"]);
// destroy the session 
session_destroy(); 

header("Location:index.html");
?>