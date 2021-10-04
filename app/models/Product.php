<?php

[
    "termékkód" => 5, //darab
    "masiktermek" => 2 //darab
];

class Product
{
    private $id;
    private $name;
    private $promo;
    private $price;
    private $stock;
    private $lead;
    private $description;

    public function __construct($id, $name, $promo, $price, $stock, $lead, $description) {
        $this->id             = $id;
        $this->name           = $name;
        $this->promo          = $promo;
        $this->price          = $price;
        $this->stock          = $stock;
        $this->lead           = $lead;
        $this->description    = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPromo()
    {
        return $this->promo;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * @return mixed
     */
    public function getLead()
    {
        return $this->lead;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }


}