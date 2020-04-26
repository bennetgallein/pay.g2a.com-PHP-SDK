<?php
namespace G2APay\Types;

use G2APay\Types\Enums\Environment;
use G2APay\Types\Enums\URLs;
use RestService\RestService;

class Payment {

    private $items;
    /**
     * 	Store API Hash
     *
     * @var string
     */
    private $hash;
    /**
     * Calculated hash
     *
     * @var string
     */
    private $calculatedHash;
    /**
     * Merchant order ID
     *
     * @var string
     */
    private $orderId;
    /**
     * Total order price
     *
     * @var string
     */
    private $amount;
    /**
     * Currency (ISO 4217)
     *
     * @var string
     */
    private $currency;
    /**
     * Optional description
     *
     * @var string
     */
    private $description;
    /**
     * Return e-mail
     *
     * @var string
     */
    private $email;
    /**
     * URL to redirect when payment fails
     *
     * @var string
     */
    private $failureUrl;
    /**
     * URL to redirect the payment is successful
     *
     * @var string
     */
    private $okUrl;
    /**
     * Cart product type: physical or digital
     *
     * @var string
     */
    private $cartType;
    /**
     * Customer IPv4 address
     *
     * @var string
     */
    private $customerIPAddress;

    private $env;
    private $secret;
    private $header;


    public function __construct($env = Environment::PRODUCTION) {
        $this->env = $env;
    }

    public function create() {

        $restService = new RestService();
        
        try {
            $res = $restService
                ->setEndpoint($this->env ? URLs::prod_quote : URLs::sandbox_quote)
                ->setRequestHeaders([
                    'Authorization' => $this->header
                ])
                ->post('/index/createQuote', [
                    'api_hash' => $this->hash,
                    'hash' => $this->getCalculatedHash(),
                    'order_id' => $this->getOrderId(),
                    'amount' => $this->getAmount(),
                    'currency' => $this->getCurrency(),
                    'email' => $this->getEmail(),
                    'url_failure' => $this->getFailureUrl(),
                    'url_ok' => $this->getOkUrl(),
                    'items' => $this->_getItems(),
                    'customer_ip_address' => $this->getCustomerIPAddress()
                ], [], true, false);
            return $res;
        } catch (\Exception $e) {
            dump($e);
        }
    }

    public function getPayment(string $token) {
        $resService = new RestService();

        try {
            $res = $resService
                ->setEndpoint($this->env ? URLs::prod_rest : URLs::sandbox_rest)
                ->setRequestHeaders([
                    'Authorization' => $this->header
                ])
                ->get("/transactions/${token}");
            return $res;
        } catch (\Exception $e) {
            dump($e);
        } 
    } 

    public function addItem(Item $item) {
        $this->items[] = $item;
        return $this;
    }

    public function addItems(array $items) {
        foreach ($items as $item) {
            $this->addItem($item);
        }
        return $this;
    }

    public function getItems() {
        return $this->items;
    }

    public function _getItems() {
        $res = [];
        foreach ($this->items as $item) {
            $res[] = [
                'sku' => $item->getSku(),
                'name' => $item->getName(),
                'amount' => $item->getAmount(),
                'qty' => $item->getQuantity(),
                'extra' => $item->getExtra(),
                'type' => $item->getType(),
                'id' => $item->getId(),
                'price' => $item->getPrice(),
                'url' => $item->getUrl()
            ];
        }
        return $res;
    }

	/**
	 * Get the value of hash
	 *
	 * @return  mixed
	 */
	public function getApiHash() {
		return $this->hash;
	}

	/**
	 * Set the value of hash
	 *
	 * @param   mixed  $hash  
	 *
	 * @return  self
	 */
	public function setApiHash($hash) {
		$this->hash = $hash;

		return $this;
	}

	/**
	 * Get calculated hash
	 *
	 * @return  string
	 */
	public function getCalculatedHash() {

        $this->calculatedHash = hash('sha256', 
            join("", [
                $this->orderId,
                $this->amount,
                $this->currency,
                $this->secret
            ])
        );

		return $this->calculatedHash;
	}

	/**
	 * Set calculated hash
	 *
	 * @param   string  $calculatedHash  Calculated hash
	 *
	 * @return  self
	 */
	public function setCalculatedHash(string $calculatedHash) {
		$this->calculatedHash = $calculatedHash;

		return $this;
	}

	/**
	 * Get merchant order ID
	 *
	 * @return  string
	 */
	public function getOrderId() {
		return $this->orderId;
	}

	/**
	 * Set merchant order ID
	 *
	 * @param   string  $orderId  Merchant order ID
	 *
	 * @return  self
	 */
	public function setOrderId(string $orderId) {
		$this->orderId = $orderId;

		return $this;
	}

	/**
	 * Get total order price
	 *
	 * @return  string
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Set total order price
	 *
	 * @param   string  $amount  Total order price
	 *
	 * @return  self
	 */
	public function setAmount(string $amount) {
		$this->amount = $amount;

		return $this;
	}

	/**
	 * Get currency (ISO 4217)
	 *
	 * @return  string
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * Set currency (ISO 4217)
	 *
	 * @param   string  $currency  Currency (ISO 4217)
	 *
	 * @return  self
	 */
	public function setCurrency(string $currency) {
		$this->currency = $currency;

		return $this;
	}

	/**
	 * Get optional description
	 *
	 * @return  string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Set optional description
	 *
	 * @param   string  $description  Optional description
	 *
	 * @return  self
	 */
	public function setDescription(string $description) {
		$this->description = $description;

		return $this;
	}

	/**
	 * Get return e-mail
	 *
	 * @return  string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Set return e-mail
	 *
	 * @param   string  $email  Return e-mail
	 *
	 * @return  self
	 */
	public function setEmail(string $email) {
		$this->email = $email;

		return $this;
	}

	/**
	 * Get uRL to redirect when payment fails
	 *
	 * @return  string
	 */
	public function getFailureUrl() {
		return $this->failureUrl;
	}

	/**
	 * Set uRL to redirect when payment fails
	 *
	 * @param   string  $failureUrl  URL to redirect when payment fails
	 *
	 * @return  self
	 */
	public function setFailureUrl(string $failureUrl) {
		$this->failureUrl = $failureUrl;

		return $this;
	}

	/**
	 * Get uRL to redirect the payment is successful
	 *
	 * @return  string
	 */
	public function getOkUrl() {
		return $this->okUrl;
	}

	/**
	 * Set uRL to redirect the payment is successful
	 *
	 * @param   string  $okUrl  URL to redirect the payment is successful
	 *
	 * @return  self
	 */
	public function setOkUrl(string $okUrl) {
		$this->okUrl = $okUrl;

		return $this;
	}

	/**
	 * Get cart product type: physical or digital
	 *
	 * @return  string
	 */
	public function getCartType() {
		return $this->cartType;
	}

	/**
	 * Set cart product type: physical or digital
	 *
	 * @param   string  $cartType  Cart product type: physical or digital
	 *
	 * @return  self
	 */
	public function setCartType(string $cartType) {
		$this->cartType = $cartType;

		return $this;
	}

	/**
	 * Get customer IPv4 address
	 *
	 * @return  string
	 */
	public function getCustomerIPAddress() {
		return $this->customerIPAddress;
	}

	/**
	 * Set customer IPv4 address
	 *
	 * @param   string  $customerIPAddress  Customer IPv4 address
	 *
	 * @return  self
	 */
	public function setCustomerIPAddress(string $customerIPAddress) {
		$this->customerIPAddress = $customerIPAddress;

		return $this;
	}

	/**
	 * Get the value of secret
	 *
	 * @return  mixed
	 */
	public function getSecret() {
		return $this->secret;
	}

	/**
	 * Set the value of secret
	 *
	 * @param   mixed  $secret  
	 *
	 * @return  self
	 */
	public function setSecret($secret) {
		$this->secret = $secret;

		return $this;
	}

	/**
	 * Get the value of header
	 *
	 * @return  mixed
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * Set the value of header
	 *
	 * @param   mixed  $header  
	 *
	 * @return  self
	 */
	public function setHeader($header) {
		$this->header = $header;

		return $this;
	}
}