<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator\Generator;

class AgeGenerator implements GeneratorInterface
{
    public static function generate ( $additionalInfo = [] )
    {
        $minAge = 1; 
        $maxAge = 100;
        
        if ( array_key_exists ('minAge', $additionalInfo) )
        {
            $minAge = (int)$additionalInfo ['minAge'];
        }
        
        if ( array_key_exists ('maxAge', $additionalInfo) )
        {
            $maxAge = (int)$additionalInfo ['maxAge'];
        }
        
        return rand ($minAge, $maxAge);
    }
}

