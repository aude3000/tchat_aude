<?php
/*****************************/
/*  USER_MANAGER MODEL CLASS */
/*****************************/

class User_manager
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
     * Récupère la liste des utilisateurs du tchat sous la forme
     * d'un tableau à deux dimensions
     *
     * @return array Tableau à deux dimensions listant les
     * utilisateurs du tchat
     */
    public function listAll()
    {
        // Je prépare la requête SQL
        $query = "SELECT * FROM users ORDER BY userNickName";
        // Je charge la requête SQL dans la couche d'abstraction PDO
        $myPDOStatement = $this->DBConnection->prepare($query);
        // J'exécute notre requête SQL
        $myPDOStatement->execute();
        // Je retourne les résultats SQL (liste des
        // utilisateurs) sous la forme d'un tableau à deux
        // dimensions
        $usersListAllArray = $myPDOStatement->fetchAll();
        return $usersListAllArray;
    }

    public function exists($userNickName)
    {
        $query = "SELECT * FROM users WHERE userNickName = :userNickName";

        $boundValues = [
            'userNickName' => $userNickName
        ];

        $statement = $this->DBConnection->prepare($query);
        $statement->execute($boundValues);

        if ($statement->rowCount() === 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function userAdd($userNickName)
    {
        // On prépare notre requête SQL
        $query = "INSERT INTO users (userNickName) VALUES (:userNickName)";

        // On prépare notre tableau faisant le "binding" entre les valeurs de nos variables
        // et celles qui sont envoyées dans la requête SQL (pour éviter les injections)
        $boundValues = [
            'userNickName' => $userNickName
        ];

        // On charge notre requête SQL dans la couche d'abstraction PDO
        $statement = $this->DBConnection->prepare($query);

        // On exécute notre requête SQL (en liant notre tableau de "binding")
        $statement->execute($boundValues);
    }





}







































