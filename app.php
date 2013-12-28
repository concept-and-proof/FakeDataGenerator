<?php

/*
 * This file is a part of FakeDataGenerator
 * Brought to you by Concept&Proof 
 */

error_reporting (-1);
ini_set ('display_errors', true);

date_default_timezone_set ('UTC');

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/pimple/Pimple.php' ;

use Symfony\Component\Console\Application;
use Concept\FakeDataGenerator\Command\CreateFakeCommand;
use Concept\FakeDataGenerator\Storage\Database;
use Illuminate\Database\Capsule\Manager as Capsule;

$container = new Pimple ();

$container ['db'] = function ()
{
    $capsule = new Capsule;

    $capsule->addConnection ([
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'test',
        'username'  => 'root',
        'password'  => 'root',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    ]);
    
    return $capsule;
};

$container ['storage'] = function ($container)
{
    return new Database ($container ['db']);
};

$app = new Application ();

$createFakeCommand = new CreateFakeCommand ();
$createFakeCommand->setDiContainer ($container);
$app->add ($createFakeCommand);

$app->run ();