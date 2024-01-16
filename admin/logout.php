<?php
session_start();
if(isset($_SESSION['alogged_in']) && $_SESSION['alogged_in'] === true){
    session_unset();
    session_destroy();
}
header("Location: ../index.php");
?>