<?php

require_once "../app/models/Products.php";
require_once "../app/models/Product.php";


class NewsletterRecipients
{


    public function __construct() {
        // betöltjük fájlból


    }



    private function generateToken() {
       $token = md5("Hello world".microtime());
       return $token;
    }

    public function subscribe($email) {
        $this->recipients[$email] = $this->generateToken();


        $db = DB::getInstance();
        $stmt = $db->conn->prepare("INSERT INTO newsletter_recipients (email, token)
        SELECT :email, :token FROM DUAL
        WHERE NOT EXISTS (SELECT 1 FROM newsletter_recipients WHERE email=:email)");
        $stmt->bindValue(":email", $email);

        $stmt->execute();
    }

    public function unsubscribe($email, $token) {

        // TODO #6 : Meg kéne oldani, hogy az alábbi $request_accepted változó
        //  értéke akkor váljon igazzá, ha a megadott $email létezik a listán,
        //  vagyis van ilyen kulcsú elem a $this->recipients tömbben.
        //  -
        //  Ha van ilyen tömbelem, akkor össze kell hasonlítani a tokent a tömbben
        //  tárolt tokennel, és ha azok megegyeznek, akkor állítható be a `true`
        //  érték. Ellenkező esetben marad `false` és nem történik meg a leiratkozás

       /* $request_accepted=false;
        if(array_key_exists($email, $this->recipients)){
            if($this->getToken($email) === $token){
                $request_accepted=true;
            }
        }


        if($request_accepted) {
            unset($this->recipients[$email]);
            $this->save();
            return true;
        } else {
            return false;
        }*/



        $db = DB::getInstance();
        $stmt = $db->conn->prepare("SELECT * FROM newsletter_recipients WHERE email = :email and token = :token");
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":token", $token);
        $stmt->execute();
        $erintett_sorok_szama = $stmt->rowCount();
        if($erintett_sorok_szama===0){
            $request_accepted=false;
        }
        else{
            $request_accepted=true;

        }
        if($request_accepted) {
            unset($this->recipients[$email]);

            return true;
        } else {
            return false;
        }


    }

    public function getToken($email) {
        return $this->recipients[$email] ?? null;
    }
}