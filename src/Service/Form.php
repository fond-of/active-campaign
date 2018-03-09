<?php

namespace FondOfPHP\ActiveCampaign\Service;

use FondOfPHP\ActiveCampaign\Service;

class Form extends Service
{
    /**
     * Get all forms
     *
     * @return null|\FondOfPHP\ActiveCampaign\DataTransferObject\Form
     */
    public function getAll()
    {
        $parameters = array(
            'api_action' => 'form_getforms',
        );

        $response = $this->request($parameters);

        if ($response === null || $response->getStatusCode() !== 200) {
            return null;
        }

        $json = $response->getBody()->getContents();

        return $this->serializer->deserialize(
            $this->removeResultInformation($json),
            'array<integer, ' . \FondOfPHP\ActiveCampaign\DataTransferObject\Form::class . '>',
            'json'
        );
    }
}
