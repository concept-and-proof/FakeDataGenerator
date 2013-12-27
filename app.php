<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

error_reporting (-1);
ini_set ('display_errors', true);

date_default_timezone_set ('UTC');

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Concept\FakeDataGenerator\Command\CreateFakeCommand;
use Concept\FakeDataGenerator\Storage\Database;

function getStorage ()
{
    $options = [
        'host'     => 'localhost',
        'database' => 'test',
        'login'    => 'root',
        'password' => 'root'
    ];
    
    return new Database ($options);
}

$app = new Application ();
$app->add (new CreateFakeCommand ());
$app->run ();