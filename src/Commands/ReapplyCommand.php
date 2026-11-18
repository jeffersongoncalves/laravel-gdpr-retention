<?php

namespace JeffersonGoncalves\GdprRetention\Commands;

use JeffersonGoncalves\GdprRetention\RetentionManager;
use JeffersonGoncalves\Privacy\Retention\Commands\ReapplyCommand as BaseReapplyCommand;

class ReapplyCommand extends BaseReapplyCommand
{
    protected $signature = 'gdpr:retention-reapply';

    protected string $manager = RetentionManager::class;
}
