<?php

namespace FondOfPHP\ActiveCampaign;

use Doctrine\Common\Annotations\AnnotationRegistry;
use ErrorException;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

class Service
{
    /**
     * @var Client|null
     */
    protected $httpClient = null;

    /**
     * @var Serializer|null
     */
    protected $serializer = null;

    /**
     * @var string|null
     */
    protected $apiKey = null;

    /**
     * Service constructor.
     *
     * @param Client $httpClient
     * @param $apiKey
     * @param mixed $serializer;
     */
    public function __construct(Client $httpClient, $apiKey, $serializer = false)
    {
        $this->httpClient = $httpClient;
        $this->apiKey = $apiKey;

        if (false === $serializer) {
            $this->serializer = SerializerBuilder::create()->build();
        } else {
            $this->serializer = $serializer;
        }


        AnnotationRegistry::registerLoader('class_exists');
    }

    /**
     * Request
     *
     * @param $parameters
     * @param string $method
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    protected function request($parameters, $method = 'GET')
    {
        $formParams = $this->getFormParams($parameters);

        if (!isset($formParams['api_key'])) {
            return null;
        }

        if ($method === 'POST') {
            // split params
            $response = $this->httpClient->request($method, Api::PATH_TO_API_SCRIPT, array(
                'query' => $this->getQueryParams($parameters),
                'form_params' => $formParams
            ));
        } else {
            // all params as query GET params
            $response = $this->httpClient->request($method, Api::PATH_TO_API_SCRIPT, array(
                'query' => array_merge($this->getQueryParams($parameters), $formParams),
            ));
        }

        return $response;
    }


    /**
     * Simulate form request (we generate an same request like the html integration form from active campaign)
     * We need to do this, because this is the only way we can request an registration with double-opt-in!
     *
     * @param array $params
     * @param int $formId
     * @return null|true
     * @throws ErrorException
     */
    public function formRequest(array $params, $formId)
    {
        $params = array_merge($params, array(
            'u' => $formId,
            'f' => $formId,
            's' => '',
            'c' => '',
            'm' => '',
            'act' => 'sub',
            'v' => 2,
            'jsonp' => 'true'
        ));

        $response = $this->httpClient->request('GET', Api::URL_FORM, ['query' => $params]);

        if ($response->getStatusCode() === 200) {
            return true;
        } else {
            throw new ErrorException('form request was not successful');
        }
    }

    /**
     * Get query params
     *
     * @param array $parameters
     * @return array
     */
    protected function getQueryParams($parameters = array())
    {
        $queryParams = array();

        if (array_key_exists('api_action', $parameters)) {
            $queryParams['api_action'] = $parameters['api_action'];
        }

        return $queryParams;
    }


    /**
     * Get form params
     *
     * @param array $parameters
     * @return array
     */
    protected function getFormParams($parameters = array())
    {
        $formParams = $parameters;

        if (!array_key_exists('api_output', $formParams)) {
            $formParams['api_output'] = Api::DEFAULT_OUTPUT;
        }

        if (!array_key_exists('api_key', $formParams)) {
            $formParams['api_key'] = $this->apiKey;
        }

        return $formParams;
    }

    /**
     * Set serializer
     *
     * @param Serializer|null $serializer
     * @return $this
     */
    public function setSerializer($serializer)
    {
        $this->serializer = $serializer;

        return $this;
    }

    /**
     * Remove result information
     *
     * @param $json
     * @return string
     */
    protected function removeResultInformation($json) {
        $object = json_decode($json, false);

        if (property_exists($object, 'result_code')) {
            unset($object->result_code);
        }

        if (property_exists($object, 'result_message')) {
            unset($object->result_message);
        }

        if (property_exists($object, 'result_output')) {
            unset($object->result_output);
        }

        return json_encode($object);
    }
}
