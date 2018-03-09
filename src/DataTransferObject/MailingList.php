<?php

namespace FondOfPHP\ActiveCampaign\DataTransferObject;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Exclude;

class MailingList
{
    /**
     * @Type("integer")
     * @var int
     */
    protected $id;

    /**
     * @Type("boolean")
     * @var boolean
     */
    protected $status;

    /**
     * @Type("string")
     * @var string
     */
    protected $name;

    /**
     * @Type("integer")
     * @var int
     */
    protected $form;

    /**
     * @Exclude
     * @var string
     */
    protected $websiteUrl;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param int $form
     * @return $this
     */
    public function setForm($form)
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    /**
     * @param mixed $websiteUrl
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = (string)$websiteUrl;
    }
}
