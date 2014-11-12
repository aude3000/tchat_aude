/* TCHAT */


 // On définit une variable globale
 // permettant de stocker l'identifiant de l'utilisateur
 var userId = 0;
console.log("début du main.js");
console.log(userId);

 // Une fois que le DOM est bien chargé
 $(function () {


 // Si l'utilisateur appuie sur une touche
 // dans le champ imput d'id #userNickname
 // remarque : ne pas utiliser la balise "form" dans le html
 // dans ce contexte où on utilise l'AJAX ( ou étudier les usages ...)

 $('#userNickname').on( "keydown", function(eventObject) {
     console.log(eventObject.which);
 // Si cette touche est la touche "entrée"
 if (eventObject.which == 13)
 {
     console.log("j'entre dans le if car click sur touche entrée");
     console.log($('#userNickname').val());

 // On appelle la fonction userConnect()

 userConnect();
     console.log("la fonction userConnect a ete appelée");
     usersListRefresh();
 }


 });

 /*
 messageListRefresh();

*/

 });


 // Fonction de connection au t'chat du nouvel utilisateur
 function userConnect()
 {
     console.log("la fonction userConnect est appelée");
 $.ajax({
 // On définit l'URL appelée
 url: 'http://localhost/tchat/API/index.php',
 // On définit la méthode HTTP
 type: 'GET',
 // On définit les données qui seront envoyées
 data: {
 action: 'userAdd',
 userNickname: $('#userNickname').val()
 },
 // l'équivalent d'un "case" avec les codes de statut HTTP
 statusCode: {
 // Si l'utilisateur est bien créé

 201: function (response) {
 // On stocke l'identifiant récupéré dans la variable globale userId
 window.userId = response.userId;
 // On masque la fenêtre, puis on rafraichit la liste de utilisateurs
 // (à faire...)
     console.log("utilisateur créé");
     usersListRefresh();
 },
 // Si l'utilisateur existe déjà
 208: function (response) {
 // On fait bouger la fenêtre de gauche à droite
 // et de droite à gauche 3 fois
 // (à faire...)
     console.log("utilisateur existe déjà");
 }
 }
 })
 }

// fonction pour rafraichir la liste des utilisateurs
function usersListRefresh()
{
    $.ajax({
        url : "http://localhost/tchat/API/index.php?action=listUsers",
        type : "GET"
    }).done(function(response)
    {
        $('#usersList').empty();

        for(var i=0; i<response.length; i++)
        {
            $('#liste_pseudos').append('<li>' + response[i].userNickName + '</li>');
        }
    });
}







