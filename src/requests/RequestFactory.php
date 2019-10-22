<?php

namespace APIClient\Requests;

class RequestFactory{

    private $url;

    private $id;

    private $token;

    private $debugFile;

    /**
     * RequestFactory constructor.
     * @param string $url
     * @param int $id
     * @param string $token
     * @param string|null $debugFile
     */
    public function __construct(string $url, int $id, string $token, string $debugFile = null)
    {
        $this->url = $url;

        $this->id = $id;

        $this->token = $token;

        $this->debugFile = $debugFile;
    }

    public function createServiceRequest()
    {
        return new ServiceRequest($this->url, $this->id, $this->token, $this->debugFile);
    }

    public function createTransactionRequest()
    {
        return new TransactionRequest($this->url, $this->id, $this->token, $this->debugFile);
    }

}