<?php
require_once '../app/controllers/BasicController.php';
require_once '../app/models/Products.php';

class FrontPageController extends BasicController
{
    public function __construct($URI_PARTS) {
        parent::__construct($URI_PARTS);
    }

    public function showFrontPage() {

        $products = new Products();

        $__PRODUCTS_PROMO = "";
        foreach ($products->getPromo() as $product) {

            /** @var string $__PRODUCT_CARD */
            include '../view/product_card.php';

            $__PRODUCTS_PROMO .= $__PRODUCT_CARD;
        }

        $__PRODUCTS_NORMAL = "";
        foreach ($products->getNormal() as $product) {

            /** @var string $__PRODUCT_CARD */
            include '../view/product_card.php';

            $__PRODUCTS_NORMAL .= $__PRODUCT_CARD;
        }


        include '../view/index.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);
    }
}











