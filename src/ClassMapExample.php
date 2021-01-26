<?php

// remove namespace to simulate a non-standard class psr-4.
namespace App;

class ClassMapExample
{
    public static function methodExample(): void
    {
        echo 'Example ClassMap' . PHP_EOL;
        exit();
    }
}
