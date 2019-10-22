<?php

namespace APIClient\Requests;

use APIClient\HTTPClient;

abstract class Request{

    private $id;

    private $token;

    private $url;

    private $attributes = [];

    private $debugFile = null;

    private $path = '';

    /**
     * Request constructor.
     * @param string $url
     * @param int $id
     * @param string $token
     * @param null $debugFile
     */
    public function __construct(string $url, int $id, string $token, $debugFile = null)
    {
        $this->setUrl($url);

        $this->id = $id;

        $this->token = $token;

        $this->debugFile = $debugFile;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, $attributes);
    }

    /**
     * @return string
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = trim($path, '/');
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return '/' . $this->path;
    }

    /**
     * @return \APIClient\Response
     */
    protected function execute()
    {
        $key = ceil(microtime(true) * 1000);

        $this->setAttributes([
            'auth' => [
                'id'    => $this->id,
                'key'   => $key,
                'hash'  => md5($this->id . $this->token . $key)
            ]
        ]);

        $client = new HTTPClient($this->getUrl() . $this->getPath(), json_encode($this->getAttributes()));

        if($this->debugFile)
            $client->setDebugFile($this->debugFile);

        return $client->execute();
    }

}