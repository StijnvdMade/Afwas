<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score</title>
</head>
<body>
<nav>
<form action="logout.php" method="post">
<input class="logout" type="submit" name="submit" value="Logout">
</form>
</nav>

<?php
if (!isset($_COOKIE['loggedin'])) {
    header("Location: index.php");
}
$host = '127.0.0.1';
$db   = 'afwas';
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
// get number of id's
$amount = 0;
$stmt = $pdo->query('SELECT * FROM score;');
while ($row = $stmt->fetch())
{
    $amount++;
}
//  Load score from database
$data = $pdo->query('SELECT * FROM score')->fetch(PDO::FETCH_ASSOC);
for ($i=1; $i < $amount+1; $i++) { 
    $data = $pdo->query('SELECT * FROM score WHERE id=' . $i)->fetch(PDO::FETCH_ASSOC);
    $id = $data['id'];
    $naam = $data['naam'];
    $score = $data['score'];
    $updated = $data['updated'];
    echo($naam . " heeft " . $score . " keer afgewast. Hij heeft op " . $updated . " voor het laatst afgewast </br>");
}
$omfg =  "'" . $_COOKIE['user'] . "'";

$newscore = $pdo->query("UPDATE `score` SET `score` = score + 1 WHERE `score`.`naam` = $omfg;");


echo($omfg);

?>


</body>
</html>