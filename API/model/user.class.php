<?php
/*********************/
/*  USER MODEL CLASS */
/*********************/

class User
{
    private $id;
    private $pseudo;

    public function __construct($id, $pseudo)
    {
        $this->setId($id);
        $this->setPseudo($pseudo);
    }

    // Getter $id et $pseudo pour rendre les propriétés visibles
    // de l'exterieur

    public function getId() { return $this->id;}
    public function getPseudo() { return $this->pseudo;}

    // Setter $id et $pseudo
    // Setter $id
    public function setId($id)
    {
        // On transtype (cast) le paramètre $lifeMax en nombre entier
        $id = (int) $id;

        // Si la valeur de $id est négative ou égale à 0
        if ($id <= 0)
        {
            echo 'Class ' . get_class($this) . ': $id doit être un nombre entier positif différent de 0.';
        }
        // Sinon (si elle positive et différente de 0)
        else
        {
            // On assigne la valeur de $id à la propriété "id" de l'objet en cours
            $this->id = $id;
        }
    }

    // Setter $pseudo
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

}