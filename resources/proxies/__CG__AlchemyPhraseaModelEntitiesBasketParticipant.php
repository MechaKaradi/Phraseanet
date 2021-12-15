<?php

namespace Alchemy\Phrasea\Model\Proxies\__CG__\Alchemy\Phrasea\Model\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class BasketParticipant extends \Alchemy\Phrasea\Model\Entities\BasketParticipant implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'id', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'can_modify', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'is_aware', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'is_confirmed', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'can_agree', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'can_see_others', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'reminded', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'votes', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'user', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'basket'];
        }

        return ['__isInitialized__', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'id', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'can_modify', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'is_aware', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'is_confirmed', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'can_agree', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'can_see_others', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'reminded', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'votes', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'user', '' . "\0" . 'Alchemy\\Phrasea\\Model\\Entities\\BasketParticipant' . "\0" . 'basket'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (BasketParticipant $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUser', []);

        return parent::getUser();
    }

    /**
     * {@inheritDoc}
     */
    public function getBasket()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBasket', []);

        return parent::getBasket();
    }

    /**
     * {@inheritDoc}
     */
    public function setBasket(\Alchemy\Phrasea\Model\Entities\Basket $basket)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBasket', [$basket]);

        return parent::setBasket($basket);
    }

    /**
     * {@inheritDoc}
     */
    public function getIsAware()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsAware', []);

        return parent::getIsAware();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsAware(bool $isAware)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsAware', [$isAware]);

        return parent::setIsAware($isAware);
    }

    /**
     * {@inheritDoc}
     */
    public function getCanAgree()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCanAgree', []);

        return parent::getCanAgree();
    }

    /**
     * {@inheritDoc}
     */
    public function setCanAgree(bool $canAgree)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCanAgree', [$canAgree]);

        return parent::setCanAgree($canAgree);
    }

    /**
     * {@inheritDoc}
     */
    public function getCanSeeOthers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCanSeeOthers', []);

        return parent::getCanSeeOthers();
    }

    /**
     * {@inheritDoc}
     */
    public function setCanSeeOthers(bool $canSeeOthers)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCanSeeOthers', [$canSeeOthers]);

        return parent::setCanSeeOthers($canSeeOthers);
    }

    /**
     * {@inheritDoc}
     */
    public function getReminded(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReminded', []);

        return parent::getReminded();
    }

    /**
     * {@inheritDoc}
     */
    public function setReminded(\DateTime $reminded)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReminded', [$reminded]);

        return parent::setReminded($reminded);
    }

    /**
     * {@inheritDoc}
     */
    public function addVote(\Alchemy\Phrasea\Model\Entities\BasketElementVote $basketElementVote)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addVote', [$basketElementVote]);

        return parent::addVote($basketElementVote);
    }

    /**
     * {@inheritDoc}
     */
    public function removeVote(\Alchemy\Phrasea\Model\Entities\BasketElementVote $basketElementVote)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeVote', [$basketElementVote]);

        return parent::removeVote($basketElementVote);
    }

    /**
     * {@inheritDoc}
     */
    public function isReleasable()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isReleasable', []);

        return parent::isReleasable();
    }

    /**
     * {@inheritDoc}
     */
    public function getIsConfirmed()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIsConfirmed', []);

        return parent::getIsConfirmed();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsConfirmed(bool $isConfirmed)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsConfirmed', [$isConfirmed]);

        return parent::setIsConfirmed($isConfirmed);
    }

    /**
     * {@inheritDoc}
     */
    public function getVotes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVotes', []);

        return parent::getVotes();
    }

}
