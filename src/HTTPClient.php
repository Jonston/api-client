<?php

namespace APIClient;

class HTTPClient{

    private $debug = false;

    private $debugFile;

    private $debugFileDescriptor;

    private $url;

    private $body;

    public function __construct($url, $body)
    {
        $this->url = $url;

        $this->body = $body;
    }

    /**
     * @param string $file
     */
    public function setDebugFile(string $file)
    {
        $this->debug = true;

        $this->debugFile = $file;

        $this->debugFileDescriptor = fopen($file, 'w+');
    }

    public function execute()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-type: application/json',
            'Content-length: ' . strlen($this->body),
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->body);

        if ($this->debug) {
            curl_setopt($ch, CURLOPT_STDERR, $this->debugFileDescriptor);
            fputs($this->debugFileDescriptor, "URL: " . $this->url . "\n");
            fputs($this->debugFileDescriptor, "BODY: \n" . var_export($this->body, true) . "\n");
        }

        $output = curl_exec($ch);
        $info = curl_getinfo($ch);

        if ($this->debug) {
            fputs($this->debugFileDescriptor, "INFO: \n" . var_export($info, true) . "\n");
            fputs($this->debugFileDescriptor, "OUTPUT: \n" . var_export($output, true) . "\n");
        }

        return new Response($output, $info);
    }
}