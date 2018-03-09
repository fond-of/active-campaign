<?php

namespace FondOfPHP\ActiveCampaign\DataTransferObject;

use JMS\Serializer\Annotation\Type;

class ContactMailingListRelation
{
    /**
     * @Type("integer")
     * @var int
     */
    protected $listid;

    /**
     * @Type("integer")
     * @var int
     */
    protected $status;

    /**
     * @return int
     */
    public function getListId()
    {
        return $this->listid;
    }

    /**
     * @param int $listId
     * @return $this
     */
    public function setListId($listId)
    {
        $this->listid = $listId;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
