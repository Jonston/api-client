<?php

namespace APIClient\Requests;

class TransactionRequest extends Request{

    /**
     * TransactionRequest constructor.
     * @param string $url
     * @param int $id
     * @param string $token
     * @param string|null $debugFile
     */
    public function __construct(string $url, int $id, string $token, string $debugFile = null)
    {
        parent::__construct($url, $id, $token, $debugFile);
    }

    /**
     * @param string $customer
     * @param float $amount
     * @param string $product
     * @param string|null $transactionId
     * @param bool $simulation
     * @return \APIClient\Response
     */
    public function checkTransaction(
        string $customer,
        float $amount,
        string $product,
        string $transactionId = null,
        bool $simulation = false
    )
    {
        $this->setPath('transaction/check');

        $this->setAttributes(['product' => $product]);

        $this->setAttributes([
            'fields' => [
                'customer'  => $customer,
                'account'   => $customer,
                'amount'    => $amount
            ]
        ]);

        if($simulation)
            $this->setAttributes(['simulation' => true]);

        if($transactionId)
            $this->setAttributes(['external_transaction_id' => $transactionId]);

        return $this->execute();
    }

    /**
     * @param float $amount
     * @param string $id
     * @param string $transactionId
     * @return \APIClient\Response
     */
    public function confirmTransaction(float $amount, string $id, string $transactionId)
    {
        $this->setAttributes([
            'id'            => $id,
            'transactionId' => $transactionId,
            'fields'        => [
                'amount' => $amount
            ]
        ]);

        return $this->execute();
    }
}