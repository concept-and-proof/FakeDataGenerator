<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator\Generator;

interface GeneratorInterface 
{
    public static function generate ( $additionalInfo = [] );
}