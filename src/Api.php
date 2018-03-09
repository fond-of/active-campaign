<?php

namespace FondOfPHP\ActiveCampaign;

use FondOfPHP\ActiveCampaign\Service\Contact;
use FondOfPHP\ActiveCampaign\Service\Form;
use FondOfPHP\ActiveCampaign\Service\MailingList;
use GuzzleHttp\Client;

class Api
{
    const PATH_TO_API_SCRIPT = 'admin/api.php';
    const DEFAULT_OUTPUT = 'json';
    const URL_FORM = 'https://fondof.activehosted.com/proc.php';

    /**
     * @var null|Client
     */
    protected $httpClient = null;

    /**
     * @var null|string
     */
    protected $key = null;

    /**
     * @var null|string
     */
    protected $baseUri = null;

    /**
     * @var array
     */
    protected $services = array();

    /**
     * Constructor
     *
     * @param $baseUri
     * @param $key
     */
    public function __construct($baseUri, $key)
    {
        $this->baseUri = $baseUri;
        $this->key = $key;

        $this->initHttpClient();
    }

    /**
     * Initialize client
     *
     * @return $this
     */
    protected function initHttpClient()
    {
        $this->httpClient = new Client([
            'base_uri' => $this->baseUri
        ]);

        return $this;
    }

    /**
     * Retrieve contact service
     *
     * @return Contact
     */
    public function getContactService()
    {
        if (!array_key_exists('contact', $this->services)) {
            $this->services['contact'] = new Contact($this->httpClient, $this->key);
        }

        return $this->services['contact'];
    }

    /**
     * Retrieve contact service
     *
     * @return MailingList
     */
    public function getMailingListService()
    {
        if (!array_key_exists('mailing_list', $this->services)) {
            $this->services['mailing_list'] = new MailingList($this->httpClient, $this->key);
        }

        return $this->services['mailing_list'];
    }

    /**
     * Retrieve contact service
     *
     * @return Form
     */
    public function getFormService()
    {
        if (!array_key_exists('form', $this->services)) {
            $this->services['form'] = new Form($this->httpClient, $this->key);
        }

        return $this->services['form'];
    }
}
