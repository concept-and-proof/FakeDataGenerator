<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator\Storage;

use Concept\FakeDataGenerator\FakeEntityInterface;
use Concept\FakeDataGenerator\FakeObjectCollection;

interface StorageInterface
{
    public function addOne ( FakeEntityInterface $fakeObject );
    
    public function addMany ( FakeObjectCollection $fakeObjectCollection );
}