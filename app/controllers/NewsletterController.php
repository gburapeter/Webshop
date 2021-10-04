<?php

require_once '../app/controllers/BasicController.php';

class NewsletterController extends BasicController
{

    public function __construct($URI_PARTS) {
        parent::__construct($URI_PARTS);
    }

    public function unsubscribe($DATA) {

        if(array_key_exists("email", $DATA) && array_key_exists("token", $DATA)) {
            // Check existence of the order:
            $newsletter_recipients = new NewsletterRecipients();
            $t = $newsletter_recipients->unsubscribe($DATA['email'], $DATA['token']);

            if(!$t) {
                // order not found -> show info
                $__INFO_TITLE = "Nem sikerült a művelet!";
                $__INFO_APOLOGY = "A megadott címmel nincs feliratkozott felhasználó, vagy hibás a leiratkozási kulcs.";
            } else {
                $__INFO_TITLE = "Sikeres leiratkozás!";
                $__INFO_APOLOGY = "Ön nem fog a jövőben több hírelevelt kapni tőlünk.";
            }

            include '../view/info.php';

            /** @var string $__CONTENT */
            $this->show($__CONTENT);
            exit;

        } else {

            include '../view/unsubscribe_form.php';

            /** @var string $__CONTENT */
            $this->show($__CONTENT);
        }


    }

}