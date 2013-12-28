<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator\Storage;

use Concept\FakeDataGenerator\FakeEntityInterface;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database implements StorageInterface
{   
    public function __construct (Capsule $connection)
    {
        $connection->setAsGlobal ();    
    }
    
    public function addOne ( FakeEntityInterface $fakeObject )
    {
        // $tableName property must be specified in order to make
        // database storage driver work properly
        
        if ( ! property_exists ( $fakeObject, 'tableName' ) 
                || is_null ($fakeObject->tableName) 
           )
        {
            throw new \InvalidArgumentException (
                sprintf (
                    'please specify %s::$tableName', 
                    get_class ($fakeObject)
                )
            );
        }
        
        $tableName = $fakeObject->tableName;
        
        $data = [];
        foreach ($fakeObject->listFields () as $field)
        {
            $data [$field] = $fakeObject->get ($field);
        }
        
        return Capsule::table ($tableName)->insert ($data);
    }    
}
