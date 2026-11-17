<?php

namespace JeffersonGoncalves\GdprRetention;

use Illuminate\Support\Facades\Event;
use JeffersonGoncalves\Gdpr\Events\PersonalDataAnonymized;
use JeffersonGoncalves\GdprRetention\Commands\ReapplyCommand;
use JeffersonGoncalves\GdprRetention\Commands\RetentionCommand;
use JeffersonGoncalves\GdprRetention\Listeners\RecordTombstones;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GdprRetentionServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('gdpr-retention')
            ->hasConfigFile()
            ->hasMigrations(['create_gdpr_retention_tombstones_table'])
            ->hasCommands([RetentionCommand::class, ReapplyCommand::class]);
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(RetentionManager::class);
    }

    public function packageBooted(): void
    {
        Event::listen(PersonalDataAnonymized::class, RecordTombstones::class);
    }
}
