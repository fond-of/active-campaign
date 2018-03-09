<?php

namespace FondOfPHP\ActiveCampaign\Transfer;

class ResponseDummy
{
    /**
     * @var bool
     */
    protected $valid;

    /**
     * @param bool $valid
     */
    public function __construct($valid = true)
    {
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getStatusCode() {
        return ($this->valid === true) ? 200 : 500;
    }

    public function getBody() {
        return new class {
            public function getContents() {
                return json_encode(new class {});
            }
        };
    }
}