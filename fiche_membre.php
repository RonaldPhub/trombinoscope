<?php
$titre = "Fiche membre";
include '_header.php';
?>
<a href="accueil.php"><--Retour à l'accueil</a>
<h1>Ma fiche</h1>

<?php
$dsn = 'mysql:host=localhost;dbname=membre_message';
$login = 'root';
$pass = '';
try {
    $dbh = new PDO($dsn, $login, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $dbh->query('SELECT * FROM membre WHERE IS_ADMIN=1', PDO::FETCH_ASSOC);
    foreach ($stmt as $ligne) {
        //var_dump($ligne);
    }

?>

    <div class="ligne-membre">
        <img src="upload/<?= $ligne['PHOTO'] ?>">
        <p><?= $ligne['PSEUDO'] ?></p>
        <p><?= $ligne['DESCRIPTION'] ?></p>
    </div>


<?php

} catch (PDOException $e) {
    echo 'Erreur PDO : ' . $e->getMessage();
    echo '<br>code = ' . $e->getCode();
}


//make user modify his profile-------------direct him to other user to send message(ideas())
?>

<a href="modification_de_fiche.php?id=<?= $ligne['CODE_MEMBRE'] ?>">Modification de la fiche--></a><br />
<a href="mes_messages.php">Mes messages--></a><br />
<?php
include '_footer.php';
?>