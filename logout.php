<?php 
session_start();
session_destroy();
header("location:/monitoring/gate/index.php?pesan=logout");
?>