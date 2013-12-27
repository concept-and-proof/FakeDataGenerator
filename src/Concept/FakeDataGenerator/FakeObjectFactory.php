<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator;

class FakeObjectFactory
{
    protected $_fakeObject = null; 
    protected $_amount = null;
    
    public static function create ()
    {        
        return new static;
    }    
    
    public function setFakeObject (FakeEntityInterface $fakeObject)
    {
        $this->_fakeObject = $fakeObject;
    }
    
    public function setAmount ($amount)
    {
        $amount = (int)$amount;
        
        if (0 >= $amount)
        {
            throw new \InvalidArgumentException ();
        }
        
        $this->_amount = $amount;
    }
    
    public function produce ()
    {        
        if (is_null ($this->_amount) || is_null ($this->_fakeObject))
        {
            throw new \BadMethodCallException ();
        }
        
        for ( $i = 0; $i < $this->_amount; $i++ )
        {
            $fakeObject = clone $this->_fakeObject;
            $fakeObject->fillInData ();
            yield ($fakeObject); // new php 5.5 feature in action!
        }
    }
}
