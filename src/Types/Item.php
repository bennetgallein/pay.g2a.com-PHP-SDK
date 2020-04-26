<?php

namespace G2APay\Types;

class Item {

    /**
     * Item SKU
     *
     * @var string
     */
    private $sku;
    /**
     * Item name
     *
     * @var string
     */
    private $name;
    /**
     * Total item price (quantity x price)
     *
     * @var float
     */
    private $amount;
    /**
     * Item quantity
     *
     * @var int
     */
    private $quantity;
    /**
     * 	Item optional description
     *
     * @var string
     */
    private $extra;
    /**
     * 	Item optional type
     *
     * @var string
     */
    private $type;
    /**
     * 	Unique item ID in your system
     *
     * @var string
     */
    private $id;
    /**
     * Single item price
     *
     * @var float
     */
    private $price;
    /**
     * Item URL
     *
     * @var string
     */
    private $url;


    public function __construct() {
        return $this;
    }

    /**
     * Get item SKU
     *
     * @return  string
     */
    public function getSku() {
        return $this->sku;
    }

    /**
     * Set item SKU
     *
     * @param  string  $sku  Item SKU
     *
     * @return  self
     */
    public function setSku(string $sku) {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get item name
     *
     * @return  string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set item name
     *
     * @param  string  $name  Item name
     *
     * @return  self
     */
    public function setName(string $name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get total item price (quantity x price)
     *
     * @return  float
     */
    public function getAmount() {
        return $this->amount;
    }

    /**
     * Set total item price (quantity x price)
     *
     * @param  float  $amount  Total item price (quantity x price)
     *
     * @return  self
     */
    public function setAmount(float $amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get item quantity
     *
     * @return  int
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Set item quantity
     *
     * @param  int  $quantity  Item quantity
     *
     * @return  self
     */
    public function setQuantity(int $quantity) {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get 	Item optional description
     *
     * @return  string
     */
    public function getExtra() {
        return $this->extra;
    }

    /**
     * Set 	Item optional description
     *
     * @param  string  $extra  	Item optional description
     *
     * @return  self
     */
    public function setExtra(string $extra) {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get 	Item optional type
     *
     * @return  string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set 	Item optional type
     *
     * @param  string  $type  	Item optional type
     *
     * @return  self
     */
    public function setType(string $type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get 	Unique item ID in your system
     *
     * @return  string
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set 	Unique item ID in your system
     *
     * @param  string  $id  	Unique item ID in your system
     *
     * @return  self
     */
    public function setId(string $id) {
        $this->id = $id;

        return $this;
    }

    /**
     * Get single item price
     *
     * @return  float
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Set single item price
     *
     * @param  float  $price  Single item price
     *
     * @return  self
     */
    public function setPrice(float $price) {
        $this->price = $price;

        return $this;
    }

    /**
     * Get item URL
     *
     * @return  string
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     * Set item URL
     *
     * @param  string  $url  Item URL
     *
     * @return  self
     */
    public function setUrl(string $url) {
        $this->url = $url;

        return $this;
    }
}
