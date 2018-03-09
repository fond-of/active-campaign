<?php

namespace FondOfPHP\ActiveCampaign\DataTransferObject;

use JMS\Serializer\Annotation\Type;

class Form
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
    protected $disabled;

    /**
     * @Type("string")
     * @var string
     */
    protected $name;

    /**
     * @Type("boolean")
     * @var boolean
     */
    protected $sendoptin;

    /**
     * @Type("array")
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
     * @return Form
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param boolean $disabled
     * @return $this
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
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
     * @return boolean
     */
    public function getSendOptIn()
    {
        return $this->sendoptin;
    }

    /**
     * @param boolean $sendOptIn
     * @return Form
     */
    public function setSendOptIn($sendOptIn)
    {
        $this->sendoptin = $sendOptIn;
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
