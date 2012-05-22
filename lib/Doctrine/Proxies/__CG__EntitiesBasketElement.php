<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class BasketElement extends \Entities\BasketElement implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }


    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();

        return parent::getId();
    }

    public function setRecordId($recordId)
    {
        $this->__load();

        return parent::setRecordId($recordId);
    }

    public function getRecordId()
    {
        $this->__load();

        return parent::getRecordId();
    }

    public function setSbasId($sbasId)
    {
        $this->__load();

        return parent::setSbasId($sbasId);
    }

    public function getSbasId()
    {
        $this->__load();

        return parent::getSbasId();
    }

    public function setOrd($ord)
    {
        $this->__load();

        return parent::setOrd($ord);
    }

    public function getOrd()
    {
        $this->__load();

        return parent::getOrd();
    }

    public function setCreated($created)
    {
        $this->__load();

        return parent::setCreated($created);
    }

    public function getCreated()
    {
        $this->__load();

        return parent::getCreated();
    }

    public function setUpdated($updated)
    {
        $this->__load();

        return parent::setUpdated($updated);
    }

    public function getUpdated()
    {
        $this->__load();

        return parent::getUpdated();
    }

    public function setBasket(\Entities\Basket $basket)
    {
        $this->__load();

        return parent::setBasket($basket);
    }

    public function getBasket()
    {
        $this->__load();

        return parent::getBasket();
    }

    public function getRecord()
    {
        $this->__load();

        return parent::getRecord();
    }

    public function setRecord(\record_adapter $record)
    {
        $this->__load();

        return parent::setRecord($record);
    }

    public function setLastInBasket()
    {
        $this->__load();

        return parent::setLastInBasket();
    }

    public function addValidationData(\Entities\ValidationData $validationDatas)
    {
        $this->__load();

        return parent::addValidationData($validationDatas);
    }

    public function getValidationDatas()
    {
        $this->__load();

        return parent::getValidationDatas();
    }

    public function getUserValidationDatas(\User_Adapter $user)
    {
        $this->__load();

        return parent::getUserValidationDatas($user);
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'record_id', 'sbas_id', 'ord', 'created', 'updated', 'validation_datas', 'basket');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }

    }
}
