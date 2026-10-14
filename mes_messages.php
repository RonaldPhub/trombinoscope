<?php
$titre = "Mes messages(v2)";
include '_header.php';
?>
<a href="accueil.php"><--Retour à l'accueil</a>
<h1>Mes messages</h1>

<?php

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

//var_dump($_POST);

?>

<main>

    <article>

        <?php
        $dsn = 'mysql:host=localhost;dbname=membre_message';
        try {
            //1
            $stmt = $dbh->query('SELECT * FROM membre', PDO::FETCH_ASSOC);
            foreach ($stmt as $ligne) {
                //var_dump($ligne);
        ?>


                <div class="ligne-membre">
                    <a href="message_echange.php?id=<?= $ligne['CODE_MEMBRE'] ?>">
                        <img src="upload/<?= $ligne['PHOTO'] ?>" alt="">
                    </a>
                    <p><?= $ligne['PSEUDO'] ?></p>
                    <p><?= $ligne['DESCRIPTION'] ?></p></br>
                </div>

        <?php
            }
        } catch (PDOException $e) {
        }

        ?>

    </article>


    <?php
    include '_footer.php';
    ?>