<?php

namespace APIClient;

class Response {

    private $output = '';

    private $info = '';

    /**
     * Response constructor.
     * @param $output
     * @param $info
     */
    public function __construct($output, $info)
    {
        $this->output = $output;

        $this->info = $info;
    }

    /**
     * @param bool $encoded
     * @return mixed
     */
    public function getOutput(bool $encoded = true)
    {
        return $encoded ? json_decode($this->output) : $this->output;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return bool
     */
    public function success()
    {
        return ! isset($this->getOutput()->error);
    }

    /**
     * @return bool
     */
    public function failure()
    {
        return isset($this->getOutput()->error);
    }

    /**
     * @return null
     */
    public function getError()
    {
        return $this->failure() ? $this->getOutput()->error : null;
    }

}