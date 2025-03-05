<?php

session_start();

require_once("./models/Jeu.php");

$jeu = new Jeu("X");
$jeu->jouer();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles-tiktaktoePHP.css">
    <title>Tik Tak Toe</title>
</head>

<body>
    <main>
        <section class="game">
            <?php if ($jeu->get_verif() == false): ?>


                <div class="msg-joueur">
                    <?php if (empty($jeu->erreur)): ?>
                        <?php if ($_SESSION['joueur'] == "X" and $jeu->tour > 1): ?>
                            <h1 class="joueur2">Joueur O </h1>
                            <p class="joueur2">c'est à vous de jouer !</p>
                        <?php else: ?>
                            <h1 class="joueur1">Joueur X </h1>
                            <p class="joueur1">c'est à vous de jouer !</p>
                        <?php endif; ?>
                    <?php else : ?>
                        <p class="msg"><?= $jeu->erreur ?></p>
                    <?php endif; ?>
                </div>



                <table>
                    <thead></thead>
                    <tbody>

                        <form method="post" action="">
                            <?php for ($i = 1; $i <= 9; $i++): ?>
                                <td>
                                    <input id="case" type="submit" name="<?= $i; ?>" value="<?= $_SESSION['grille'][$i - 1] ?>">
                                </td>
                                <?php if ($i % 3 == 0) : ?>
                                    <tr>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </form>
                    </tbody>
                </table>

                <div>
                    <p class="tour">
                        Numéro tour : <span><?= $jeu->tour ?></span>
                    </p>
                </div>

            <?php else : ?>
                <form method="get" action="">

                    <div class="msg-joueur">
                        <?php if (!empty($jeu->message)): ?>
                            <p class="msg"><?= $jeu->message ?></p>
                        <?php endif; ?>
                        <input type="submit" id="rejouer" name="rejouer" value="Rejouer">
                    </div>
                </form>
                <table>
                    <thead></thead>
                    <tbody>

                        <form method="post" action="">
                            <?php for ($i = 1; $i <= 9; $i++): ?>
                                <td>
                                    <p id="case" class="case"><?= $_SESSION['grille'][$i - 1] ?></p>
                                </td>
                                <?php if ($i % 3 == 0) : ?>
                                    <tr>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>


                        </form>
                    </tbody>
                </table>

                <div>
                    <p class="tour">
                        Numéro tour : <span><?= $jeu->tour ?></span>
                    </p>
                </div>

            <?php endif; ?>

        </section>
    </main>
</body>

</html>