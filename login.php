<nav>
<form action="logout.php" method="post">
<input class="logout" type="submit" name="submit" value="Logout">
</form>
</nav>
<?php

$host = '127.0.0.1';
$db   = 'Afwas';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}
echo $pdo->query('select version()')->fetchColumn();

$gebruikersnaam = $_POST['gebruikersnaam'];
$wachtwoord = $_POST['wachtwoord'];
$sql = "select * from security.gebruikers";
$stnt = $pdo->prepare($sql);
$stnt->execute();
$array = $stnt->fetch(PDO::FETCH_OBJ);
if ($array->gebruikersnaam == $gebruikersnaam && $array->wachtwoord == $wachtwoord) {
    echo '<h1>succes</h1>';
    setcookie('logdin', $array->id);
} else {
    echo '<h1>niggah you fake</h1>';
}
?>
<a href="score.php">Score</a>
