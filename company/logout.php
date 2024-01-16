<?php
session_start();
if(isset($_SESSION['clogged_in']) && $_SESSION['clogged_in'] === true){
    session_unset();
    session_destroy();
}
header("Location: ../index.php");
?>