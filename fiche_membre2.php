<?php
$titre = "Fiche membre";
include '_header.php';
?>
<a href="accueil.php"><--Retour à l'accueil</a>
<h1>Fiche de membre</h1>


<?php
//Connexion du BD
$dsn = 'mysql:host=localhost;dbname=membre_message';
$login = 'root';
$pass = '';
try {
    $dbh = new PDO($dsn, $login, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur PDO : ' . $e->getMessage();
    echo '<br>code = ' . $e->getCode();
}



try {
    //Premier requete
    $sql = 'SELECT * FROM membre WHERE CODE_MEMBRE=:code_membre';
    $stmt = $dbh->prepare($sql);

    // var_dump($_GET);
    // var_dump($_POST);

    $stmt->execute([
        ':code_membre' => $_GET['id'],
    ]);
    $ligne = $stmt->fetch();

    //Deuxieme requete
    if (!empty($_POST)) {
        $sql2 = 'INSERT INTO message(DE_MEMBRE, A_MEMBRE, MESSAGE) VALUES (:admin , :code_membre, :message)';
        $stmt2 = $dbh->prepare($sql2);
        $stmt2->execute([
            ':admin' => 1,
            ':code_membre' => $_GET['id'],
            ':message' => $_POST['message'],
        ]);
    }

?>
    <div class="ligne-membre">
        <img src="upload/<?= $ligne['PHOTO'] ?>">
        <p><?= $ligne['PSEUDO'] ?></p>
        <p><?= $ligne['DESCRIPTION'] ?></p>
    </div>
    <form method="POST" action="">
        <input type="hidden" name="code_membre" value="<?= $ligne['CODE_MEMBRE'] ?>">
        <textarea name="message" placeholder="Message"></textarea><br />
        <input type="submit" name="envoie" value="Envoyer" />
    </form>
<?php
} catch (PDOException $e) {
    echo 'Erreur PDO : ' . $e->getMessage();
    echo '<br>code = ' . $e->getCode();
}


?>

<?php



//make user modify his profile-------------direct him to other user to send message(ideas())
?>

<?php
include '_footer.php';
?>