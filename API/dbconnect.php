<?php

// dbconnect.php

/***********************************/
/* CONNEXION A LA BASE DE DONNEES  */
/***********************************/

/* dans ce fichier je crée un objet de type PDO, car créé à partir de la classe PDO */
/* --> new PDO */

try
{
    $PDO = new PDO("mysql:host=localhost;dbname=tchat;charset=UTF8", "3wa", "troiswa");
}
catch (PDOException $exceptionObject)
{
    echo 'Erreur de connection PDO (' . $exceptionObject->getCode() . '): ' . $exceptionObject->getMessage();

    exit();
}
