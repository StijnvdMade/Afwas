<?php
if(isset($_POST['submit'])) {
    unset($_COOKIE['logdin']);
    $deleted = setcookie('logdin', '', time() - 3600);
    header("Location: index.php");
}
?>
