<?php

require_once '../app/controllers/BasicController.php';

class SimplePageController extends BasicController
{

    public function __construct($URI_PARTS) {
        parent::__construct($URI_PARTS);
    }

    public function showTerms() {

        include '../view/terms.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);
    }

    public function showAllProducts() {

        $products = new Products();

        $__ALL_PRODUCTS = "";
        foreach ($products->getAll() as $product) {

            /** @var string $__PRODUCT_CARD */
            include '../view/product_card.php';

            $__ALL_PRODUCTS .= $__PRODUCT_CARD;
        }

        include '../view/product_lister.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);

    }

    public function showProduct($id) {

        $products = new Products();

        $__PRODUCTS_RANDOM = "";
        for($k=0;$k<3;$k++) {

            /** @var string $__PRODUCT_CARD */
            $product = $products->getRandom();

            include '../view/product_card.php';
            $__PRODUCTS_RANDOM .= $__PRODUCT_CARD;
        }

        $product = $products->getProductById($id);

        if(!$product) {
            header("Location: ". BASEURL . "/404");
        }

        include '../view/product_details.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);
    }

    public function showError($code) {

        // Default
        $__ERROR_CODE    = $code;
        $__ERROR_TITLE   = "Hiba";
        $__ERROR_APOLOGY = "Sajánljuk, de a keresett erőforrás kiszolgálása közben hiba történt.";
        http_response_code(400);

        if($code == 404) {
            $__ERROR_CODE    = "404";
            $__ERROR_TITLE   = "Nem található";
            $__ERROR_APOLOGY = "Sajánljuk, de a keresett oldal nem található.";
            http_response_code(404);
        } elseif ($code == 403) {
            $__ERROR_CODE    = "403";
            $__ERROR_TITLE   = "Hozzáférés megtagadva";
            $__ERROR_APOLOGY = "Sajánljuk, de a keresett erőforrást Ön nem érheti el.";
            http_response_code(403);
        }elseif ($code == 401) {
            $__ERROR_CODE    = "401";
            $__ERROR_TITLE   = "Nincs bejelentkezve";
            $__ERROR_APOLOGY = "Sajánljuk, de a keresett erőforrás eléréséhez Önnek be kell jelentkeznie.";
            http_response_code(401);
        }

        include '../view/error.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);

    }

}