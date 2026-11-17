<?php

namespace JeffersonGoncalves\GdprRetention\Tests;

use JeffersonGoncalves\GdprRetention\GdprRetentionServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app): array
    {
        return [
            GdprRetentionServiceProvider::class,
        ];
    }
}
