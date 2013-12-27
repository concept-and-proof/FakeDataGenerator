<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

namespace Concept\FakeDataGenerator\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

use Concept\FakeDataGenerator\FakeObjectFactory;

class CreateFakeCommand extends Command
{
    protected function configure ()
    {
        $this->setName ('fake:create');
        $this->setDefinition (
        [
            ( new InputOption ('entity', null, InputOption::VALUE_REQUIRED) ),
            ( new InputOption ('amount', null, InputOption::VALUE_REQUIRED) ),
        ]);
    }
    
    protected function execute (InputInterface $input, OutputInterface $output)
    {
        $amount = intval ($input->getOption ('amount'));
        $entity = ucfirst (trim ($input->getOption ('entity')));
        
        $fullClassName = sprintf ('\\FakeClass\\%s', $entity);
        
        if (0 >= $amount)
        {
            throw new \InvalidArgumentException ();
        }
        
        if ( ! class_exists ($fullClassName) )
        {
            throw new \UnexpectedValueException (
                "Unable to load {$fullClassName}"
            );
        }
        
        $output->writeln (
            "<info>Generating {$amount} '{$entity}' objects...</info>"
        );
            
        $factory = FakeObjectFactory::create ();
        $factory->setAmount ($amount);
        $factory->setFakeObject (new $fullClassName);
        
        $storage = getStorage ();
        
        foreach ($factory->produce () as $fakeObject)
        {
            $storage->addOne ($fakeObject);
        }
        
        $output->writeln ('<info>Completed successfully</info>');
    }
}

