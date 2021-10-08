<?php 
include('./database/db.php');
session_start();

  session_destroy();
  header('location: ./login');
?>