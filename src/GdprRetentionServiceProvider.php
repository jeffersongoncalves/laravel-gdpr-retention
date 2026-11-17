<?php

namespace JeffersonGoncalves\GdprRetention;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GdprRetentionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-gdpr-retention')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations();
    }
}
