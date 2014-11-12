<?php
/********************************/
/*  MESSAGE_MANAGER MODEL CLASS */
/********************************/

class Message_manager
{
    protected $DBConnection;
    /**
     * Constructeur
     *
     * @param PDO $PDO Un objet PDO représentant la connexion
     * à la BDD
     */
    public function __construct($DBConnection)
    {
        $this->setDBConnection($DBConnection);
    }

    // Setter de la propriété $DBConnection
    public function setDBConnection(PDO $DBConnectionObject)
    {
        $this->DBConnection = $DBConnectionObject;
    }

    /**
     * listAll
     *
     * Récupère la liste des messages du tchat sous la forme
     * d'un tableau à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les
     * messages du tchat
     */
    public function listAll()
    {
        $query = "SELECT * FROM users, messages WHERE users.userId = messages.userId ORDER BY messages.messageDate ASC";
        $myPDOStatement = $this->DBConnection->prepare($query);
        $myPDOStatement->execute();

        return $myPDOStatement->fetchAll();
    }

    /**
     * add
     *
     * Ajoute les messages dans la base de données
     *
     * @param int           $userId        Identifiant de l'utilisateur
     * @param varchar(255)  $messageValue  contenu du message
     *
     */
    public function addMessage($userId, $messageValue)
    {

        $query = "INSERT INTO messages  (userId, messageValue) VALUES (:userId, :value)";

        $messageValuesArray =
            [
                'userId'=> $userId,
                'value' => $messageValue
            ];
        /* préparer la query */
        $myPDOStatement = $this->DBConnection->prepare($query);
        /*executer la requete automatiquement */
        $myPDOStatement->execute($messageValuesArray);


    }

    /**
     * Contrôle s'il existe un message ayant cet identifiant dans la BDD
     *
     * @param  int    $messageId    Identifiant du message
     * @return bool                 Renvoie TRUE si c'est le cas, FALSE sinon
     */
    public function exists($messageId)
    {
        $query = "SELECT * FROM messages WHERE messageId = :messageId";

        $boundValues = [
            'messageId' => $messageId
        ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundValues);

        if ($statement->rowCount() === 0)
        {
            return false;
        }
        else
        {
            return true;
        }
    }


/*
SELECT * FROM users, messages
WHERE users.userId = messages.userId
ORDER BY messages.messageDate ASC

/* $query = "SELECT * FROM messages ORDER BY messageDate ASC"; */

}