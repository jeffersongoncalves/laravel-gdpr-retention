<?php

namespace JeffersonGoncalves\GdprRetention\Commands;

use JeffersonGoncalves\GdprRetention\RetentionManager;
use JeffersonGoncalves\Privacy\Retention\Commands\RetentionCommand as BaseRetentionCommand;

class RetentionCommand extends BaseRetentionCommand
{
    protected $signature = 'gdpr:retention {--dry-run : Only count the records that would be anonymized}';

    protected string $manager = RetentionManager::class;
}
