<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator;

interface FakeEntityInterface
{
    public function fillInData ();
    
    public function listFields ();
    
    public function get ($key);
    
    public function set ($key, $value);
}
