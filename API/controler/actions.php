<?php

// controller/actions.php

/*******************************/
/*   LISTER LES UTILISATEURS   */
/*******************************/

// j'instancie l' objet $userManager
// basée sur la classe User_manager qui sollicite par le biais
// de sa fonction  __constructeur() de passer en paramètre
// l'objet de type PDO instancié dans le fichier dbconnect.php
// c'est à dire la variable "$PDO"
// pour pouvoir lister les utilisateurs sur la page d'accueil

$userManager = new User_manager($PDO);

if (isset($_GET['action']) && $_GET['action'] === 'listUsers')
{
    // Je vérifie le contenu de la variable $_GET['action']
    //echo $_GET['action']; --> on doit obtenir "lisUsers"

    // J'applique la fonction listAll() sur l'objet $userManager
    // pour récupérer la liste des utilisateurs du tchat dans un
    // Array (format du return de la fonction listAll)
    $usersListArray = $userManager->listAll();
    //print_r($usersListArray);

    //on obtient un résultat de ce type :
    /*
     * Array
    (
        [0] => Array
            (
                [userId] => 8
                [0] => 8
                [userNickName] => Anne
                [1] => Anne
            )

        [1] => Array
            (
                [userId] => 11
                [0] => 11
                [userNickName] => Arthur
                [1] => Arthur
            )
        ...
    )
     */

    // Je convertis le contenu de l'Array "$usersListArray"
    // obtenu en représentation JSON avec la fonction
    // json_encode avec en paramètre cette Array ("$usersListArray" )
    $usersListFormatJSON =  json_encode($usersListArray);
    echo $usersListFormatJSON;

    // on obtient un résultat de ce type :
    /* en haut à droite de l'écran il y a 2 boutons :
    /* "Raw" et "Parsed"
    /* Par défaut on est sur le bouton "Parsed" et on obtient :
    /* [
        {
        "0": "8",
        "1": "Anne",
        "userId": "8",
        "userNickName": "Anne"
        },
        {
        "0": "11",
        "1": "Arthur",
        "userId": "11",
        "userNickName": "Arthur"
        },
        {
        "0": "1",
        "1": "Aude",
        "userId": "1",
        "userNickName": "Aude"
        },
        ... (sans virgule sur le dernier élément {})
        ]
    /*
    /* en cliquant sur le bouton "Raw" on obtient l'écriture en ligne :
     * [{"userId":"8","0":"8","userNickName":"Anne","1":"Anne"},{"userId":"11","0":"11","userNickName":"Arthur","1":"Arthur"},
     * ... (aussi sans virgule sur le dernier élément {}]
     */

}

/***************************/
/*   LISTER LES MESSAGES   */
/***************************/

// j'instancie l' objet $messageManager
// basée sur la classe Message_manager qui sollicite par le biais
// de sa fonction  __constructeur() de passer en paramètre
// l'objet de type PDO instancié dans le fichier dbconnect.php
// c'est à dire la variable "$PDO"
// pour pouvoir lister les messages sur la page d'accueil

$messageManager = new Message_manager($PDO);

if (isset($_GET['action']) && $_GET['action'] === 'listMessages')
{
    //echo $_GET['action']; --> on doit obtenir "listMessages"
    // J'applique la fonction listAll() sur l'objet $messageManager
    // pour récupérer la liste des messages du tchat dans un
    // Array (format du return de la fonction listAll)
    $messagesListArray = $messageManager->listAll();
    //print_r($messagesListArray);

    //on obtient par exemple :
    /*
     * Array
    (
        [0] => Array
            (
                [messageId] => 1
                [0] => 1
                [messageValue] => Salut ça va ?
                [1] => Salut ça va ?
                [messageDate] => 2014-11-07 11:26:22
                [2] => 2014-11-07 11:26:22
                [userId] => 3
                [3] => 3
            )

        [1] => Array
            (
                [messageId] => 2
                [0] => 2
                [messageValue] => ouaih'p
                [1] => ouaih'p
                [messageDate] => 2014-11-07 11:26:22
                [2] => 2014-11-07 11:26:22
                [userId] => 8
                [3] => 8
            )

        ...
    )
     */

// Je convertis le contenu de l'Array "$messagesListArray"
// obtenu en représentation JSON avec la fonction
// json_encode avec en paramètre cette Array ("$usersListArray" )
$messagesListFormatJSON =  json_encode($messagesListArray);
echo $messagesListFormatJSON;

// on obtient par exemple
/*
 * [{"messageId":"1","0":"1","messageValue":"Salut \u00e7a va ?","1":"Salut \u00e7a va ?","messageDate":"2014-11-07 11:26:22","2":"2014-11-07 11:26:22","userId":"3","3":"3"},{"messageId":"2","0":"2","messageValue":"ouaih'p","1":"ouaih'p","messageDate":"2014-11-07 11:26:22","2":"2014-11-07 11:26:22","userId":"8","3":"8"},
 * ...]
 */

}

/**************************************************/
/*   AJOUTER UN MESSAGES DANS LA BASE DE DONNEES  */
/**************************************************/



if(isset($_GET['action']) == true && $_GET['action'] === 'addMessage')
{
    //$currentUser = $_GET['userId'];
    //$currentMessage = $_GET['messageValue'];

    $messageManager->addMessage($_GET['userId'], $_GET['messageValue']);

}

/***********************************************************************/
/* AJOUTER UN UTILISATEUR DANS LA BASE DE DONNEES ET RETOURNER SON ID  */
/***********************************************************************/

if(isset($_GET['action']) == true && $_GET['action'] === 'userAdd')
{
    echo "<br>";
    echo $_GET['userNickname'];
    echo "<br>";
    $returnExists = $userManager->exists($_GET['userNickname']);
    echo "<br>";
    echo $returnExists;

    if($returnExists === true)
    {
        http_response_code(201);
        $userManager->userAdd($_GET['userNickname']);

    }
    else
    {
        http_response_code(208);
    }
}




























