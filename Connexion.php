<?php $titre = "Connexion" ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title><?= $titre ?></title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php
    if (!empty($_POST)) {
        var_dump($_POST);

        $login = $_POST["login"];
        $pass = $_POST["pass"];

        if (empty($login && $pass)) {
            echo "Veuillez saisir un identifian et mot de passessss";
        } elseif (empty($login)) {
            echo "Veuillez saisir un identifiant";
        } elseif (empty($pass)) {
            echo "Veuillez saisir un mot de pass";
        } else {
            header('Location: accueil.php');
        }
    }
    ?>


    <div>
        <form method="post" action="">

            <label for="login-field">Login</label>
            <input id="login-field" name="login" type="text">


            <label for="pass-field">Mot de passe</label>
            <input id="pass-field" name="pass" type="password">

            <input type="submit" value="Valider">

        </form>
        <?php
        if (isset($erreur)) {
            echo '<font color="red">' . $erreur . "</font>";
        }
        ?>
    </div>

    <footer>

        <p>© <?= date('Y') ?> LeProf - Tous droits réservés - Toute reproduction interdite sans autorisation</p>
    </footer>

</body>

</html>