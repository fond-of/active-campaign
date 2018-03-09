<?php

namespace FondOfPHP\ActiveCampaign\Transfer;

class ResponseDummy
{
    protected $valid;

    public function __construct($valid = true)
    {
        $this->valid = $valid;

        return $this;
    }

    public function getStatusCode() {
        /** @see https://de.wikipedia.org/wiki/HTTP-Statuscode */
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