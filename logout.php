<?php
if(isset($_POST['submit'])) {
    unset($_COOKIE['loggedin']);
    $deleted = setcookie('loggedin', '', time() - 3600);
    header("Location: index.php");
}
?>
