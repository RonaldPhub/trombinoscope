<?php
$titre = "Mes messages(v2)";
include '_header.php';
?>
<h1>Message</h1>


<a href="accueil.php"><--Retour à l'accueil</a>

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

//var_dump($_GET);

?>

<main>

    <article>

        <?php
        try {
            
                $stmt2 = $dbh->query('SELECT * FROM membre INNER JOIN MESSAGE ON MEMBRE.CODE_MEMBRE = MESSAGE.DE_MEMBRE;', PDO::FETCH_ASSOC);
                foreach ($stmt2 as $ligne2) {
                    //var_dump($ligne2);
                    if($ligne2['A_MEMBRE'] == $_GET['id']){
                        ?>
                        <p><?= $ligne2['MESSAGE']?></p>
                        <?php
                    }
                }
        ?>

        <?php
            
        } catch (PDOException $e) {
            echo 'Erreur PDO : ' . $e->getMessage();
            echo '<br>code = ' . $e->getCode();
        }


        ?>


    <?php
    include '_footer.php';
    ?>