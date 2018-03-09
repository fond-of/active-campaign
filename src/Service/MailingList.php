<?php

namespace FondOfPHP\ActiveCampaign\Service;

use FondOfPHP\ActiveCampaign\Service;

class MailingList extends Service
{
    /**
     * Get multiple mailing lists by ids
     *
     * @param array $ids
     * @return null|\FondOfPHP\ActiveCampaign\DataTransferObject\MailingList
     */
    public function getByIds(array $ids)
    {
        if (empty($ids)) {
            return null;
        }

        $parameters = array(
            'api_action' => 'list_list',
            'ids' => implode(',', $ids)
        );

        $response = $this->request($parameters);

        if ($response === null || $response->getStatusCode() !== 200) {
            return null;
        }

        $json = $response->getBody()->getContents();

        return $this->serializer->deserialize(
            $this->removeResultInformation($json),
            'array<integer, ' . \FondOfPHP\ActiveCampaign\DataTransferObject\MailingList::class . '>',
            'json'
        );
    }

    /**
     * Get all
     *
     * @return null|\FondOfPHP\ActiveCampaign\DataTransferObject\MailingList
     */
    public function getAll()
    {
        $parameters = array(
            'api_action' => 'list_list',
            'ids' => 'all'
        );

        $response = $this->request($parameters);

        if ($response === null || $response->getStatusCode() !== 200) {
            return null;
        }

        $json = $response->getBody()->getContents();

        return $this->serializer->deserialize(
            $this->removeResultInformation($json),
            'array<integer, ' . \FondOfPHP\ActiveCampaign\DataTransferObject\MailingList::class . '>',
            'json'
        );
    }
}
