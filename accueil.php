<?php
$titre = "Acceuil";
include '_header.php';
?>

<h2>Bonjour Ronald, bienvenue dans le group OJ</h2>
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
        <h1>Acceuil</h1>

        <?php
        $dsn = 'mysql:host=localhost;dbname=membre_message';
        try {
            $stmt = $dbh->query('SELECT * FROM membre', PDO::FETCH_ASSOC);
            foreach ($stmt as $ligne) {
                //var_dump($ligne);
        ?>

                <div class="ligne-membre">
                    <a href="fiche_membre2.php?id=<?= $ligne['CODE_MEMBRE']?>, ?nom=<?= $ligne['PSEUDO'] ?>">
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