<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator;

abstract class FakeEntity implements FakeEntityInterface
{
    public $tableName = null;
    
    abstract public function fillInData ();
    
    protected $_data = [];
    
    protected function set ($key, $value)
    {
        $this->_data [(string)$key] = $value;
    }
    
    public function get ($key)
    {
        $key = (string)$key;
        
        if ( ! array_key_exists ($key, $this->_data) )
        {
            throw new \UnexpectedValueException (
                "Unable to find key {$key}"
            );
        }
        
        return $this->_data [$key];
    }
    
    // magic method
    public function __get ($key)
    {
        return $this->get ($key);
    }
    
    public function listFields ()
    {
        return array_keys ($this->_data);
    }
}


