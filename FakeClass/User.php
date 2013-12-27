<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace FakeClass;

use Concept\FakeDataGenerator\FakeEntity;
use Concept\FakeDataGenerator\Generator\AgeGenerator;

class User extends FakeEntity
{
    public function fillInData ()
    {
        $limits = [
            'minAge' => 16,
            'maxAge' => 25
        ];
        
        $this->set ('age', AgeGenerator::generate ($limits));
    }
}
