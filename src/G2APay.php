<?php
namespace G2APay;

use G2APay\Types\Enums\Environment;
use G2APay\Types\Enums\URLs;
use G2APay\Types\Payment;

class G2APay {

    private $token;

    private $merchantMail;
    private $hash;
    private $secret;

    private $env;

    /**
     * constructor for the main class. Takes and initalizes all the 
     * important variables and tokens.
     *
     * @param string $merchantMail this is the merchants mail
     * @param string $hash the hash from the store
     * @param string $secret the secret from the store
     * @param int $env sandbox or production env
     */
    public function __construct(string $merchantMail, string $hash, string $secret, $env = Environment::PRODUCTION) {
        
        $this->merchantMail = $merchantMail;
        $this->hash = $hash;
        $this->secret = $secret;
        $this->env = $env;

        $this->token = hash('sha256', 
            $hash . $merchantMail . $secret
        );
    }

    public function setEnv(int $env) {
        $this->env = $env;
    }

    public function getAuthorizationHeader() {
        return $this->hash . ';' . $this->token;
    }

    public function createPayment() {
        $payment = new Payment($this->env);
        $payment
            ->setApiHash($this->hash)
            ->setSecret($this->secret)
            ->setHeader($this->getAuthorizationHeader());
        return $payment;
    }

    /**
     * get the authentication token
     *
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * get the merchants email that'll be used for the communication
     *
     * @return string
     */
    public function getMerchantMail(): string {
        return $this->merchantMail;
    }

    /**
     * get the hash given in the constructor
     *
     * @return string
     */
    public function getHash(): string {
        return $this->hash;
    }

    /**
     * get the api-secret
     *
     * @return string
     */
    public function getSecret(): string {
        return $this->secret;
    }

    public function getCheckoutUrl(string $token): string {
        return ($this->env ? URLs::prod_quote : URLs::sandbox_quote) .  "/index/gateway?token=${token}";
    }
}