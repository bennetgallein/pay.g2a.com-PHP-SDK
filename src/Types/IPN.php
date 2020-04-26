<?php
namespace G2APay\Types;

class IPN {

    private $env;
    private $apiSecret;

    /**
     * the transaction type
     *
     * @var string
     */
    private $type;
    /**
     * the transaction ID
     *
     * @var string
     */
    private $transactionId;
    /**
     * your systems order id
     *
     * @var string
     */
    private $userOrderId;
    /**
     * the amount of the payment
     *
     * @var float
     */
    private $amount;
    /**
     * the currency of the payment
     *
     * @var string
     */
    private $currency;
    /**
     * the current status of the transaction
     *
     * @var string
     */
    private $status;
    /**
     * timestamp when the order was created
     *
     * @var string
     */
    private $orderCreatedAt;
    /**
     * timestamp when to order was completed
     *
     * @var string
     */
    private $orderCompletedAt;
    /**
     * the refunded amount
     *
     * @var float
     */
    private $refundedAmount;
    /**
     * the provision amount
     *
     * @var float
     */
    private $provisionAmount;
    /**
     * the hash of the payment
     *
     * @var string
     */
    private $hash;

    public function __construct(string $env, array $loadFrom = $_POST) {
        $this->env = $env;
        $this->loadFromVar($loadFrom);
    }

    /**
     * set the API Secret
     *
     * @param string $apiSecret
     * @return void
     */
    public function setApiSecret(string $apiSecret) {
        $this->apiSecret = $apiSecret;
        return $this;
    }

    /**
     * load the class variables from the array given
     *
     * @param array $post
     * @return $this
     */
    private function loadFromVar(array $post) {
        $this->type = $post['type'];
        $this->transactionId = $post['transactionId'];
        $this->userOrderId = $post['userOrderId'];
        $this->amount = $post['amount'];
        $this->currency = $post['cy'];
        $this->status = $post['status'];
        $this->orderCreatedAt = $post['orderCreatedAt'];
        $this->orderCompletedAt = $post['orderCompletedAt'];
        $this->refundedAmount = $post['refundedAmount'];
        $this->provisionAmount = $post['provisionAmount'];
        $this->hash = $post['hash'];

        return $this;
    }

    /**
     * validate the hash that's coming from the IPN
     *
     * @param string $transactionId your systems transaction id saved on return
     * @param [type] $orderId your systems order id
     * @param float $amount your systems saved amount for the transaction
     * @return bool
     */
    public function validateHash(string $transactionId, $orderId, float $amount): bool {
        $hash = hash('sha256', join([$transactionId, $orderId, $amount, $this->apiSecret]));

        return ((bool) strcmp($this->hash, $hash));
    }

	/**
	 * Get the transaction type
	 *
	 * @return  string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Set the transaction type
	 *
	 * @param   string  $type  the transaction type
	 *
	 * @return  self
	 */
	public function setType(string $type) {
		$this->type = $type;

		return $this;
	}

	/**
	 * Get the transaction ID
	 *
	 * @return  string
	 */
	public function getTransactionId() {
		return $this->transactionId;
	}

	/**
	 * Set the transaction ID
	 *
	 * @param   string  $transactionId  the transaction ID
	 *
	 * @return  self
	 */
	public function setTransactionId(string $transactionId) {
		$this->transactionId = $transactionId;

		return $this;
	}

	/**
	 * Get your systems order id
	 *
	 * @return  string
	 */
	public function getUserOrderId() {
		return $this->userOrderId;
	}

	/**
	 * Set your systems order id
	 *
	 * @param   string  $userOrderId  your systems order id
	 *
	 * @return  self
	 */
	public function setUserOrderId(string $userOrderId) {
		$this->userOrderId = $userOrderId;

		return $this;
	}

	/**
	 * Get the amount of the payment
	 *
	 * @return  float
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * Set the amount of the payment
	 *
	 * @param   float  $amount  the amount of the payment
	 *
	 * @return  self
	 */
	public function setAmount(float $amount) {
		$this->amount = $amount;

		return $this;
	}

	/**
	 * Get the currency of the payment
	 *
	 * @return  string
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * Set the currency of the payment
	 *
	 * @param   string  $currency  the currency of the payment
	 *
	 * @return  self
	 */
	public function setCurrency(string $currency) {
		$this->currency = $currency;

		return $this;
	}

	/**
	 * Get the current status of the transaction
	 *
	 * @return  string
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * Set the current status of the transaction
	 *
	 * @param   string  $status  the current status of the transaction
	 *
	 * @return  self
	 */
	public function setStatus(string $status) {
		$this->status = $status;

		return $this;
	}

	/**
	 * Get timestamp when the order was created
	 *
	 * @return  string
	 */
	public function getOrderCreatedAt() {
		return $this->orderCreatedAt;
	}

	/**
	 * Set timestamp when the order was created
	 *
	 * @param   string  $orderCreatedAt  timestamp when the order was created
	 *
	 * @return  self
	 */
	public function setOrderCreatedAt(string $orderCreatedAt) {
		$this->orderCreatedAt = $orderCreatedAt;

		return $this;
	}

	/**
	 * Get timestamp when to order was completed
	 *
	 * @return  string
	 */
	public function getOrderCompletedAt() {
		return $this->orderCompletedAt;
	}

	/**
	 * Set timestamp when to order was completed
	 *
	 * @param   string  $orderCompletedAt  timestamp when to order was completed
	 *
	 * @return  self
	 */
	public function setOrderCompletedAt(string $orderCompletedAt) {
		$this->orderCompletedAt = $orderCompletedAt;

		return $this;
	}

	/**
	 * Get the refunded amount
	 *
	 * @return  float
	 */
	public function getRefundedAmount() {
		return $this->refundedAmount;
	}

	/**
	 * Set the refunded amount
	 *
	 * @param   float  $refundedAmount  the refunded amount
	 *
	 * @return  self
	 */
	public function setRefundedAmount(float $refundedAmount) {
		$this->refundedAmount = $refundedAmount;

		return $this;
	}

	/**
	 * Get the provision amount
	 *
	 * @return  float
	 */
	public function getProvisionAmount() {
		return $this->provisionAmount;
	}

	/**
	 * Set the provision amount
	 *
	 * @param   float  $provisionAmount  the provision amount
	 *
	 * @return  self
	 */
	public function setProvisionAmount(float $provisionAmount) {
		$this->provisionAmount = $provisionAmount;

		return $this;
	}
}