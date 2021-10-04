<?php

require_once "../app/controllers/SimplePageController.php";
require_once "../app/controllers/FrontPageController.php";
require_once "../app/controllers/OrderController.php";
require_once "../app/controllers/AdminController.php";
require_once "../app/controllers/BasketController.php";
require_once "../app/controllers/NewsletterController.php";

$URI_PARTS = explode("?", $_SERVER['REQUEST_URI']);
$URI_PARTS = explode("/", $URI_PARTS[0]);
$URI_PARTS = array_slice($URI_PARTS, 3);

// Create base URL for absolute references:
define("USERNAME", explode('/', $_SERVER['SCRIPT_FILENAME'])[2]);  // path: /home/username/public/router.php
const BASEURL   = "/webprog/" . USERNAME;                                   // result is /webprog/username

// Start session
session_start();

if ($URI_PARTS[0] == "") {
    // Kezdőlap
    $controller = new FrontPageController($URI_PARTS);
    $controller->showFrontPage();

} else if ($URI_PARTS[0] == "products") {
    // Termékek listázása
    $controller = new SimplePageController($URI_PARTS);

    if(count($URI_PARTS) > 1) {
        // Midnen termék listázása
        $controller->showProduct($URI_PARTS[1]);
    } else {
        // Csak a kiválasztott termék listázása
        $controller->showAllProducts();
    }

} else if ($URI_PARTS[0] == "order") {
    // Megrendelés űrlap
    $controller = new OrderController($URI_PARTS);
    $controller->showOrderForm();

} else if ($URI_PARTS[0] == "track") {
    // Megrendelés állapota
    $controller = new OrderController($URI_PARTS);
    $controller->trackOrder($_GET);

} else if ($URI_PARTS[0] == "terms") {
    // ÁSZF oldal
    $controller = new SimplePageController($URI_PARTS);
    $controller->showTerms();

}  else if ($URI_PARTS[0] == "unsubscribe") {
    // Leiratkozás
    $controller = new NewsletterController($URI_PARTS);
    $controller->unsubscribe($_GET);

} else if ($URI_PARTS[0] == "api" && count($URI_PARTS) > 1) {
    // API URL-ek

    if ($URI_PARTS[1] == "save-order") {
        // Megrendelés mentése
        $controller = new OrderController($URI_PARTS);
        $controller->saveOrder($_POST);
    } else if($URI_PARTS[1] == "basket-add") {
        // Kosárba tevés
        $controller = new BasketController();
        $controller->add($_POST);
    }
} else if ($URI_PARTS[0] == "admin") {

    $controller = new AdminController($URI_PARTS);

    if( array_key_exists('is_admin', $_SESSION) && $_SESSION['is_admin'] === true ) {
        $controller->showOrders();

    } else {
        $controller->authenticate($_POST);
    }

} else {
    // 404-es hiba, egy kicsit szebben:
    $controller = new SimplePageController($URI_PARTS);
    $controller->showError(404);
}