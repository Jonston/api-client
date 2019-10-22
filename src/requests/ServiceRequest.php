<?php

namespace APIClient\Requests;

class ServiceRequest extends Request{

    /**
     * ServiceRequest constructor.
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
     * @return \APIClient\Response
     */
    public function getList()
    {
        $this->setPath('services');

        return $this->execute();
    }

}