<nav>
<form action="logout.php" method="post">
<input class="logout" type="submit" name="submit" value="Logout">
</form>
</nav>
<?php

$host = '127.0.0.1';
$db   = 'security';
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
// echo $pdo->query('select version()')->fetchColumn();

$gebruikersnaam = $_POST['gebruikersnaam'];
$wachtwoord = $_POST['wachtwoord'];
$users = [];
// get number of users
$count = 0;
$stmt = $pdo->query('SELECT * FROM gebruikers;');
while ($row = $stmt->fetch())
{
    $count++;
}
$data = $pdo->query('SELECT * FROM gebruikers;')->fetch(PDO::FETCH_ASSOC);
for ($i=1; $i < $count+1; $i++) { 
    $data = $pdo->query('SELECT * FROM gebruikers WHERE id=' . $i)->fetch(PDO::FETCH_ASSOC);
    $id = $data['id'];
    $gebruikersnaamDB = $data['gebruikersnaam'];
    $wachtwoordDB = $data['wachtwoord'];
    array_push($users, $gebruikersnaamDB, $wachtwoordDB);
}
$aantalusers = count($users);
for($x = 0; $x < $aantalusers; $x++) {
    echo $users[$x];
    echo "<br>";
  }
$number = 0;
for ($i=1; $i < $count; $i++) { 
    if ($users[$number] == $gebruikersnaam) {
        echo '<h1>yes</h1>';
    }
    $number+2;
}
if ($gebruikersnaam == $gebruikersnaamDB && $wachtwoord == $wachtwoordDB) {
    echo '<h1>succes</h1>';
    setcookie('loggedin', $id);
    setcookie('user',$gebruikersnaam);
} else {
    echo '<h1>niggah you fake</h1>';
}
?>
<a href="score.php">Score</a>
