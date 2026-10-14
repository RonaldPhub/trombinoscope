<?php
$titre = "Gestion des membres";
include '_header.php';
?>
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
        <h1>Liste des membres</h1>

        <a href="accueil.php"><--Retour à l'accueil</a>
        <?php
        $dsn = 'mysql:host=localhost;dbname=membre_message;charset=UTF8';
        try {
            $stmt = $dbh->query('SELECT * FROM membre', PDO::FETCH_ASSOC);
            foreach ($stmt as $ligne) {
                //var_dump($ligne);
        ?>

                <div class="ligne-membre">
                    <img src="upload/<?= $ligne['PHOTO'] ?>" alt="">
                    <p><?= $ligne['PSEUDO'] ?></p>
                    <p><?= $ligne['DESCRIPTION'] ?></p></br>
                    <form method="post" action="suppression_memebres">
                        <input type="hidden" name="CODE_MEMBRE" value="<?= $ligne['CODE_MEMBRE'] ?>">
                        <input type="submit" value="Supprimer" onclick="return confirm('Etes-vous sûr de vouloir supprimer cet étudiant ?')">

                    </form>
                    <a href="modification_de_fiche.php?id=<?= $ligne['CODE_MEMBRE'] ?>"><button>Modifier</button></a>

                    <!--<a href="modif_etudiant.php?CODE_MEMBRE=<?= $ligne['CODE_MEMBRE'] ?>"><button>Modifier</button></a>  -->
                </div>

        <?php
            }
        } catch (PDOException $e) {
            echo 'Erreur PDO : ' . $e->getMessage();
            echo '<br>code = ' . $e->getCode();
        }

        ?>

    </article>

    <a href="ajouts_membres.php">Ajout membre--></a> <br />

    <?php
    include '_footer.php';
    ?>