<?php

namespace FondOfPHP\ActiveCampaign\Service;

use FondOfPHP\ActiveCampaign\Service;

class Contact extends Service
{
    /**
     * Retrieve by email
     *
     * @param $email
     * @return null|\FondOfPHP\ActiveCampaign\DataTransferObject\Contact
     */
    public function getByEmail($email)
    {
        if (!is_string($email) || empty($email)) {
            return null;
        }

        $parameters = array(
            'api_action' => 'contact_view_email',
            'email' => $email
        );

        $response = $this->request($parameters);



        if ($response === null || $response->getStatusCode() !== 200) {
            return null;
        }

        $json = $response->getBody()->getContents();

        return $this->serializer->deserialize(
            $this->removeResultInformation($json),
            \FondOfPHP\ActiveCampaign\DataTransferObject\Contact::class,
            'json'
        );
    }


    /**
     * Update
     *
     * @param array $data
     * @return \FondOfPHP\ActiveCampaign\DataTransferObject\Contact|null
     */
    public function update(array $data)
    {
        if (empty($data)) {
            return null;
        }

        if (!array_key_exists('id', $data) || !array_key_exists('email', $data)) {
            return null;
        }

        $data['api_action'] = 'contact_edit';
        $response = $this->request($data, 'POST');

        if ($response === null || $response->getStatusCode() !== 200) {
            return null;
        }

        $json = $response->getBody()->getContents();

        return $this->serializer->deserialize(
            $this->removeResultInformation($json),
            \FondOfPHP\ActiveCampaign\DataTransferObject\Contact::class,
            'json'
        );
    }
}
