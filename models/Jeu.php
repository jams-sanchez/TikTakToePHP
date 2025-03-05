<?php

class Jeu
{

    private array $grille;
    public string $joueur;
    public int $tour;
    private bool $verif;
    public string $message;
    public string $erreur;

    public function __construct(string $joueur)
    {
        $this->grille = $grille =
            array(' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ');
        if (!isset($_SESSION['grille'])) {
            $_SESSION['grille'] = $this->grille;
        }
        $this->joueur = $joueur;
        $this->tour = $tour = 0;
        if (!isset($_SESSION['tour'])) {
            $_SESSION['tour'] = $this->tour;
        }
        $this->message = $message = "";
        $this->erreur = $erreur = "";
        $this->verif = $verif = false;
    }

    // nombre de tour
    public function numTour(): int
    {
        if (!isset($_SESSION['joueur'])) {
            $_SESSION['joueur'] = $this->joueur;
        }

        $_SESSION['tour'] += 1;
        $this->tour = $_SESSION['tour'];
        return $this->tour;
    }

    // changement joueur
    public function joueurSymbole(): string
    {
        if ($this->joueur == 'X') {
            if ($this->tour % 2 == 0) {
                $this->joueur = "X";
                return $_SESSION['joueur'] = $this->joueur;
            } else {
                $this->joueur = "O";
                return $_SESSION['joueur'] = $this->joueur;
            }
        } else {
            if ($this->tour % 2 == 0) {
                $this->joueur = "O";
                return $_SESSION['joueur'] = $this->joueur;
            } else {
                $this->joueur = "X";
                return $_SESSION['joueur'] = $this->joueur;
            }
        }
    }

    // placement des symboles dans la grille

    public function placement(): void
    {
        if (!empty($_POST)) {

            $valuePost = array_key_first($_POST);

            if ($_SESSION['grille'][$valuePost - 1] == ' ') {
                $_SESSION['grille'][$valuePost - 1] = $this->joueurSymbole();
                $this->grille = $_SESSION['grille'];
            } else {
                $this->erreur = "choisir une autre case";
                $this->tour--;
                $_SESSION['tour'] = $this->tour;
            }
        }
    }

    // verifie les combinaisons

    public function get_verif()
    {
        return $this->verif;
    }

    public function verification(): bool
    {

        if ( // verif ligne
            $_SESSION['grille'][0] == $this->joueur &&
            $_SESSION['grille'][1] == $this->joueur &&
            $_SESSION['grille'][2] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif (
            $_SESSION['grille'][3] == $this->joueur &&
            $_SESSION['grille'][4] == $this->joueur &&
            $_SESSION['grille'][5] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif (
            $_SESSION['grille'][6] == $this->joueur &&
            $_SESSION['grille'][7] == $this->joueur &&
            $_SESSION['grille'][8] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif ( // verif colonne
            $_SESSION['grille'][0] == $this->joueur &&
            $_SESSION['grille'][3] == $this->joueur &&
            $_SESSION['grille'][6] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif (
            $_SESSION['grille'][1] == $this->joueur &&
            $_SESSION['grille'][4] == $this->joueur &&
            $_SESSION['grille'][7] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif (
            $_SESSION['grille'][2] == $this->joueur &&
            $_SESSION['grille'][5] == $this->joueur &&
            $_SESSION['grille'][8] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif ( // verif diagonal
            $_SESSION['grille'][0] == $this->joueur &&
            $_SESSION['grille'][4] == $this->joueur &&
            $_SESSION['grille'][8] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif (
            $_SESSION['grille'][2] == $this->joueur &&
            $_SESSION['grille'][4] == $this->joueur &&
            $_SESSION['grille'][6] == $this->joueur
        ) {
            $this->message = $this->joueur . " a gagné !";
            return $this->verif = true;
        } elseif (!in_array(' ', $_SESSION['grille'])) { // verif égalité
            $this->message = "Egalité";
            return $this->verif = true;
        } else {
            return $this->verif = false;
        }
    }

    // methode rejouer
    public function rejouer(): void
    {
        if (isset($_GET['rejouer'])) {
            session_destroy();
            header("Location: index.php");
        }
    }

    // déroulement jeu
    public function jouer(): void
    {
        $this->numTour();
        $this->placement();
        $this->verification();
        $this->rejouer();
    }
}
