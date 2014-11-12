/* TCHAT */

/**
* Appel en jquery Ajax de la fonction d'affichage des utilisateurs
*/

$ajax({
    url : "http://localhost/tchat/API/index.php?",
    type : "GET"
}).done(function(response)
{
    console.log(response);
});
