<?php

require_once '../app/controllers/BasicController.php';
require_once '../app/models/Orders.php';
require_once '../app/models/Basket.php';
require_once '../app/models/Product.php';
require_once '../app/models/NewsletterRecipients.php';


class OrderController extends BasicController
{
    private $basket;

    public function __construct($URI_PARTS) {
        parent::__construct($URI_PARTS);

        $this->basket = new Basket();
        $this->basket->load();
    }

    public function showOrderForm() {

        $basket_contents = $this->basket->getContents();

        include '../view/order.php';

        /** @var string $__CONTENT */
        $this->show($__CONTENT);
    }

    private function validateExists($arr, $key) {
        if(!array_key_exists($key, $arr)) {
            if(substr($key, 0, 3) == "chk") {
                return "A mező bejelölése kötelező!";
            } else {
                return "Az adat megadása kötelező!";
            }
        } else {
            return false;
        }
    }

    private function validateNotEmpty($val) {
        if(strlen($val) < 1) {
            return "A mező kitöltése kötelező!";
        } else {
            return false;
        }
    }

    private function validateEmail($val) {
        if(!filter_var($val, FILTER_VALIDATE_EMAIL)) {
            return "Megfelelő formátumú email cím megadása szükséges!";
        } else {
            return false;
        }
    }

    private function validateTerms($val) {
        if($val !== "on") {
            return "A feltételeket el kell fogadni!";
        } else {
            return false;
        }
    }

    private function validateNewsletter($val) {
        if($val !== "on" && $val !== "off") {
            return "A felkínált értékek közül kell választani!";
        } else {
            return false;
        }
    }

    public function saveOrder($DATA) {
        header("Content-Type: text/plain");
        // validation:
        $validation_errors = [];

        $validation_rules = [
            'txt-name' => 'NotEmpty',
            'txt-email' => 'Email',
            'cmb-county' => 'NotEmpty',
            'cmb-town' => 'NotEmpty',
            'txt-address' => 'NotEmpty',
            'chk-terms' => 'Terms',
            'rad-newsletter' => 'Newsletter'
        ];

        foreach ($validation_rules as $field => $rule) {
            $check_existence = $this->validateExists($DATA, $field);

            if ($check_existence) {
                $validation_errors[$field] = $check_existence;
                continue;
            }

            $checker_function = "validate" . $rule;
            $validation_errors[$field] = $this->$checker_function($DATA[$field]);

        }

        // If all array elements are false:
        $is_form_valid = !array_reduce($validation_errors, function ($c, $i) {
            return $c || $i;
        });

        if(!$is_form_valid) {
            print(json_encode($validation_errors));
            exit;
        }

        // Ilyenkor már létrehozhatjuk a rendelést:
        $customer_data = [
            'name'       => $DATA['txt-name'],
            "mail"       => $DATA['txt-email'],
            "addr"       => $DATA['txt-address'],
            "town"       => $DATA['cmb-town'],
            "county"     => $DATA['cmb-county'],
            "comment"    => $DATA['txt-comment'] ?? "",         // https://www.php.net/manual/en/language.operators.comparison.php#language.operators.comparison.coalesce
        ];

        $order = new Order();
        $order->new($customer_data, $this->basket->getContents());

        /** @var $__PDF */
        include "../view/order_summary_pdf.php";
        $ret = $order->save();

        /** @var $__MAIL_CONTENT */
        include "../view/mail_order_confirm.php";


        // Itt kell kezelni a hírlevélre való feliratkozást is:
        if($DATA['rad-newsletter'] == "on") {
            // Feliratkozott a hírlevélre
            $newsletter_recipients = new NewsletterRecipients();
            $newsletter_recipients->subscribe($DATA['txt-email']);
        }

        // Return OK on success; ERR otherwise
        if($ret) {
            // A kosár kiürítése és az "OK" visszaadása:
            $this->basket->empty();
            $this->basket->save();

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'mailgw.ppke.hu';
            $mail->Port = 25;

            $mail->setFrom("noreply@beta.dev.itk.ppke.hu");
            $mail->addAddress($order->getCustomerMail());

            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Webshop megrendelés fogadva!';
            $mail->isHTML();
            $mail->Body = $__MAIL_CONTENT;
            $mail->addStringAttachment($__PDF, "osszesito.pdf");
            $mail->send();

            print("OK|".$ret);
        } else {
            print("ERR");
        }
    }

    public function trackOrder($DATA) {

        if(array_key_exists("order-id", $DATA)) {
            // Check existence of the order:
            $orders = new Orders();

            $order = $orders->getOrderById($DATA["order-id"]);

            if(!$order) {
                // order not found -> show info
                $__INFO_TITLE = "Nincs ilyen megrendelés!";
                $__INFO_APOLOGY = "A megadott megrendelésszámmal nem létezik megrendelés a rendszerben.";
                include '../view/info.php';

                /** @var string $__CONTENT */
                $this->show($__CONTENT);
                exit;
            }

            include '../view/track_details.php';

            /** @var string $__CONTENT */
            $this->show($__CONTENT);
        } else {

            include '../view/track_form.php';

            /** @var string $__CONTENT */
            $this->show($__CONTENT);
        }


    }
}

