<?php
$titre = "Modification de la fiche";
include '_header.php';
?>

<?php
$dsn = 'mysql:host=localhost;dbname=membre_message;charset=UTF8';
$login = 'root';
$pass = '';
try {
    $dbh = new PDO($dsn, $login, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur PDO : ' . $e->getMessage();
    echo '<br>code = ' . $e->getCode();
}


if (!empty($_POST)) {
    // var_dump($_FILES);
    // var_dump($_POST);

    if (!empty($_FILES['photo']['tmp_name'])) {

        if ($_FILES['photo']['error'] != 0) {
            $error = "problème formulaire";
        } elseif ($_FILES['photo']['size'] > 5000000) {
            $error = "La photo ne doit pas dépasser 5Mo";
        } elseif (strrchr($_FILES['photo']['name'], '.') != '.jpg') {
            $error = "Format jpg attendu";
        } else {
            move_uploaded_file($_FILES['photo']['tmp_name'], 'upload/' . $_FILES['photo']['name']);
        }
    }


    if (!isset($error)) {


        $dsn = 'mysql:host=localhost;dbname=membre_message;charset=UTF8';
        try {
            $sql = 'UPDATE membre SET PSEUDO = :pseudo, MOT_DE_PASSE = :mdp, MAIL = :mail, DESCRIPTION = :description, PHOTO = :photo WHERE CODE_MEMBRE = :code_membre';
            $stmt = $dbh->prepare($sql);

            $stmt->execute([
                ':code_membre' => $_POST['code_membre'], 
                ':pseudo' => $_POST['pseudo'],
                ':mail' => $_POST['mail'],
                ':mdp' => $_POST['mot_de_passe'],
                ':description' => $_POST['description'],
                ':photo' => !empty($_FILES['photo']['tmp_name']) ? $_FILES['photo']['name'] : $_POST['photo']
            ]);

            header('Location:gestion_des_membres.php');
        } catch (PDOException $e) {
            echo 'Erreur PDO : ' . $e->getMessage();
            echo '<br>code = ' . $e->getCode();
        }
    }
}

?>


<article>
    <h1>Modifier le membre</h1>

    <?php
    if (isset($error)) {
    ?>
        <p class="error"><?= $error ?></p>
    <?php
    }

    $sql = 'SELECT * FROM membre WHERE CODE_MEMBRE = :code_membre';
    $stmt = $dbh->prepare($sql);
    
    //var_dump($_GET);
    
    $stmt->execute([
        ':code_membre' => $_GET['id']
    ]);
    $ligne = $stmt->fetch();


    ?>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="code_membre" value="<?= $ligne['CODE_MEMBRE'] ?>">
        <input type="hidden" name="photo" value="<?= $ligne['PHOTO'] ?>">
        <label>Pseudo</label>
        <input type="text" name="pseudo" value="<?= $ligne['PSEUDO'] ?>" required><br><br>
        <label>Mot de passe</label>
        <input type="text" name="mot_de_passe" value="<?= $ligne['MOT_DE_PASSE'] ?>" required><br><br>
        <label>Mail</label>
        <input type="text" name="mail" value="<?= $ligne['MAIL'] ?>" required><br><br>
        <label>Description</label>
        <textarea name="description" required><?= $ligne['DESCRIPTION'] ?></textarea><br><br>
        <label>Photo</label>
        <img src="upload/<?= $ligne['PHOTO'] ?>" width="100">
        <input type="file" name="photo" value="<?= $ligne['PHOTO'] ?>"><br><br>
        <input type="submit" value="Valider">
    </form>
</article>




<?php
include '_footer.php';
?>