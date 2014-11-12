<?php
/************************/
/*  MESSAGE MODEL CLASS */
/************************/

class Message
{
    private $id;
    private $value;
    private $date;
    private $user;

    public function __construct($id, $value, $date, User $user)
    {
        $this->setId($id);
        $this->setValue($value);
        $this->setDate($date);
        $this->setUser($date);
    }

    // Getter
    public function getId() { return $this->id;}
    public function getValue() { return $this->value;}
    public function getDate() { return $this->date;}
    public function getUser() { return $this->user;}

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
    // Setter $value
    public function setValue($value)
    {
        $this->value = $value;
    }
    // Setter $date
    public function setDate($date)
    {
        $this->date = $date;
    }
    // Setter $user
    public function setuser($user)
    {
        $this->user = $user;
    }

}

