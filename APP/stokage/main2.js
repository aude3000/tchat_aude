/* TCHAT */


 // On définit une variable globale
 // permettant de stocker l'identifiant de l'utilisateur
 var userId = 0;
console.log("je passe par là");
console.log(userId);

 // Une fois que le DOM est bien chargé
 $(function () {


 // Si l'utilisateur appuie sur une touche
 // dans le champ imput d'id #userNickname
 $('#userNickname').keypress(function(eventObject) {
 // Si cette touche est la touche "entrée"
 if (eventObject.which == 13)
 {
 // On appelle la fonction userConnect()
 userConnect();
 }
 });

 messageListRefresh();
 usersListRefresh();


 });


 // Fonction de connection au t'chat du nouvel utilisateur
 function userConnect()
 {
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
 },
 // Si l'utilisateur existe déjà
 208: function (response) {
 // On fait bouger la fenêtre de gauche à droite
 // et de droite à gauche 3 fois
 // (à faire...)
 }
 }
 })
 }








$(function()
{
    listePartcipants();
    listeMessages();
});



function listePartcipants()
{
    /* Appel en jquery Ajax de la fonction d'affichage des utilisateurs
    */
    /* $ = jQuery --> "$.ajax" équivaut à "$jQuery.ajax" */
    /* done = exécutée = ça y est = fonction jQuery */

    $.ajax({
        url : "http://localhost/tchat/API/index.php?action=listUsers",
        type : "GET"
        /* quand la page "index.php?action=listUsers" est récupérée
        (c'est à dire ".done()" = ça y est la page est récupérée */
    }).done(function(response)
    {
        /* lance la fonction anonyme (d'où juste "function" avec en paramètre
         * la variable "response" qui reçoit de façon automatique le return de
         * la fonction listAll() converti en JSON

         * la fonction anonyme que je crée a pour objectif d'afficher les
         * pseudos des participants du tchat dans l'aside dédié à cela.
         */
        
        //console.log(response);
        /* le retour dans la Console est bien au format JSON comme attendu :
         [Object, Object, Object, Object, Object, Object, Object]
         0: Object
         0: "8"
         1: "Anne"
         userId: "8"
         userNickName: "Anne"
         __proto__: Object
         1: Object
         0: "11"
         1: "Arthur"
         userId: "11"
         userNickName: "Arthur"
         __proto__: Object
         2: Object
         3: Object
         4: Object
         5: Object
         6: Object
         7: Object
         */

        /*Je fais une boucle for  sur les objets contenus dans l'objet
         "response" pour écrire la liste des pseudos dans une liste ul
         */
        console.log(response.length);
        for(var i=0; i<response.length; i++)
        {

            $('#liste_pseudos').append('<li>' + response[i].userNickName + '</li>');

        }
    });
}

function listeMessages()
{
    $.ajax({
        url : "http://localhost/tchat/API/index.php?action=listMessages",
        type : "GET"
    }).done(function(response)
    {
        console.log(response);
        /* le retour dans la Console est bien au format JSON comme attendu :
         [Object, Object, Object, Object, Object, Object, Object]
         0: Object
             0: "1",
             1: "Salut ça va ?",
             2: "2014-11-07 11:26:22",
             3: "3",
             messageId: "1",
             messageValue: "Salut ça va ?",
             messageDate: "2014-11-07 11:26:22",
             userId: "3"
         1: Object
             0: "2",
             1: "ouaih'p",
             2: "2014-11-07 11:26:22",
             3: "8",
             messageId: "2",
             messageValue: "ouaih'p",
             messageDate: "2014-11-07 11:26:22",
             userId": "8
         */

        /*Je fais une boucle for  sur les objets contenus dans l'objet
         "response" pour écrire la liste des messages dans une liste ul
         */
        console.log(response.length);
        for(var i=0; i<response.length; i++)
        {

            $('.div_date').append('<p>' + response[i].messageDate + '</p>');
            $('.div_utilisateur').append('<p>' + response[i].userNickName + '</p>');
            $('.div_message').append('<p>' + response[i].messageValue + '</p>');

        }
    });
}













