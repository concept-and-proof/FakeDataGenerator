<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator\Storage;

use Concept\FakeDataGenerator\FakeEntityInterface;

class Database implements StorageInterface
{
    protected $_pdo = null;
    
    public function __construct (array $options)
    {
        list ($host, $database, $login, $password) = $options;
        
        $dsn = sprintf ('mysql:host=%s;dbname=%s', $host, $database);
        $this->_pdo = new \PDO ($dsn, $login, $password);
    }
    
    public function addOne ( FakeEntityInterface $fakeObject )
    {
        // $tableName property must be specified in order to make
        // database storage driver work properly
        
        if ( ! property_exists ( $fakeObject, 'tableName' ) )
        {
            throw new \InvalidArgumentException (
                sprintf (
                    'please specify %s::$tableName', 
                    get_class ($fakeObject)
                )
            );
        }
        
        $tableName = $fakeObject->tableName;
        
        $statement = sprintf (
            'INSERT INTO `%s` %s VALUES %s',
            $tableName,
            $this->_compileTableNames ($fakeObject),    
            $this->_compileInsertionBlock ($fakeObject) 
        );
        
        $statement = $this->_pdo->prepare ($statement);
        
        foreach ($fakeObject->listFields () as $field)
        {
            $statement->bindValue ( 
                (':' . $field) ,
                $fakeObject->get ($field) 
            );
        }

        return $statement->execute ();
    }
    
    protected function _compileInsertionBlock ( FakeEntityInterface $fakeObject )
    {
        $data   = [];
        
        foreach ($fakeObject->listFields () as $field)
        {
            $data [] = sprintf (':%s', $field);
        }
        
        return sprintf ( '(%s)', implode (',', $data) );
    }
    
    protected function _compileTableNames ( FakeEntityInterface $fakeObject )
    {
        $data = [];
        
        foreach ($fakeObject->listFields () as $field)
        {
            $data [] = sprintf ('`%s`', $field);
        }
        
        return sprintf ('(%s)', implode (',', $data));
    }
}
