<?php

namespace FondOfPHP\ActiveCampaign\DataTransferObject;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;

class Contact
{
    /**
     * @Type("integer")
     * @var int
     */
    protected $id;

    /**
     * @Type("integer")
     * @SerializedName("subscriberid")
     * @var int
     */
    protected $subscriberId;

    /**
     * @Type("integer")
     * @SerializedName("listid")
     * @var int
     */
    protected $listId;

    /**
     * @Type("integer")
     * @SerializedName("formid")
     * @var int
     */
    protected $formId;

    /**
     * @Type("string")
     * @SerializedName("sdate")
     * @var string
     */
    protected $subscribedAt;

    /**
     * @Type("string")
     * @SerializedName("udate")
     * @var string
     */
    protected $unsubscribedAt;

    /**
     * @Type("integer")
     * @var int
     */
    protected $status;

    /**
     * @Type("string")
     * @SerializedName("first_name")
     * @var string
     */
    protected $firstName;

    /**
     * @Type("string")
     * @SerializedName("last_name")
     * @var string
     */
    protected $lastName;

    /**
     * @Type("string")
     * @var string
     */
    protected $email;

    /**
     * @Type("array<FondOfPHP\ActiveCampaign\DataTransferObject\ContactMailingListRelation>")
     * @var array
     */
    protected $lists;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Contact
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    /**
     * @param int $subscriberId
     * @return Contact
     */
    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;
        return $this;
    }

    /**
     * @return int
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * @param int $listId
     * @return Contact
     */
    public function setListId($listId)
    {
        $this->listId = $listId;
        return $this;
    }

    /**
     * @return int
     */
    public function getFormId()
    {
        return $this->formId;
    }

    /**
     * @param int $formId
     * @return Contact
     */
    public function setFormId($formId)
    {
        $this->formId = $formId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubscribedAt()
    {
        return $this->subscribedAt;
    }

    /**
     * @param string $subscribedAt
     * @return Contact
     */
    public function setSubscribedAt($subscribedAt)
    {
        $this->subscribedAt = $subscribedAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnsubscribedAt()
    {
        return $this->unsubscribedAt;
    }

    /**
     * @param string $unsubscribedAt
     * @return Contact
     */
    public function setUnsubscribedAt($unsubscribedAt)
    {
        $this->unsubscribedAt = $unsubscribedAt;
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
     * @return Contact
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return Contact
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Contact
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return array
     */
    public function getLists()
    {
        return $this->lists;
    }

    /**
     * @param array $lists
     * @return $this
     */
    public function setLists($lists)
    {
        $this->lists = $lists;
        return $this;
    }
}
