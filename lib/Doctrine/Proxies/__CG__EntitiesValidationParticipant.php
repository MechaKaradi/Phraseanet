<?php

namespace Proxies\__CG__\Entities;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class ValidationParticipant extends \Entities\ValidationParticipant implements \Doctrine\ORM\Proxy\Proxy
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

    public function setUsrId($usrId)
    {
        $this->__load();

        return parent::setUsrId($usrId);
    }

    public function getUsrId()
    {
        $this->__load();

        return parent::getUsrId();
    }

    public function addValidationData(\Entities\ValidationData $datas)
    {
        $this->__load();

        return parent::addValidationData($datas);
    }

    public function setSession(\Entities\ValidationSession $session)
    {
        $this->__load();

        return parent::setSession($session);
    }

    public function getSession()
    {
        $this->__load();

        return parent::getSession();
    }

    public function setIsAware($isAware)
    {
        $this->__load();

        return parent::setIsAware($isAware);
    }

    public function getIsAware()
    {
        $this->__load();

        return parent::getIsAware();
    }

    public function setUser(\User_Adapter $user)
    {
        $this->__load();

        return parent::setUser($user);
    }

    public function getUser()
    {
        $this->__load();

        return parent::getUser();
    }

    public function setReminded($reminded)
    {
        $this->__load();

        return parent::setReminded($reminded);
    }

    public function getReminded()
    {
        $this->__load();

        return parent::getReminded();
    }

    public function getDatas()
    {
        $this->__load();

        return parent::getDatas();
    }

    public function setIsConfirmed($isConfirmed)
    {
        $this->__load();

        return parent::setIsConfirmed($isConfirmed);
    }

    public function getIsConfirmed()
    {
        $this->__load();

        return parent::getIsConfirmed();
    }

    public function setCanAgree($canAgree)
    {
        $this->__load();

        return parent::setCanAgree($canAgree);
    }

    public function getCanAgree()
    {
        $this->__load();

        return parent::getCanAgree();
    }

    public function setCanSeeOthers($canSeeOthers)
    {
        $this->__load();

        return parent::setCanSeeOthers($canSeeOthers);
    }

    public function getCanSeeOthers()
    {
        $this->__load();

        return parent::getCanSeeOthers();
    }

    public function isReleasable()
    {
        $this->__load();

        return parent::isReleasable();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'usr_id', 'is_aware', 'is_confirmed', 'can_agree', 'can_see_others', 'reminded', 'datas', 'session');
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
