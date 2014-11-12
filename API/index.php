<?php

// index.php

// A ajouter en haut du fichier index.php
// qu'on retrouve dans la console dans l'onglet "Headers"
header('Content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

session_start();

// Création de l'objet PDO qui représente la connexion à la BDD
require_once 'dbconnect.php';

// Chargement des modèles (classes) :
require_once 'model/message.class.php';
require_once 'model/message_manager.class.php';
require_once 'model/user.class.php';
require_once 'model/user_manager.class.php';


// Chargement du contrôleur
require_once 'controler/actions.php';
