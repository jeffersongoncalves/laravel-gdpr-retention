<?php

namespace JeffersonGoncalves\GdprRetention\Commands;

use Illuminate\Console\Command;
use JeffersonGoncalves\GdprRetention\RetentionManager;

class ReapplyCommand extends Command
{
    protected $signature = 'gdpr:retention-reapply';

    protected $description = 'Re-anonymize tombstoned personal data that came back, e.g. after restoring a backup';

    public function handle(RetentionManager $retention): int
    {
        $this->info($retention->reapply().' column(s) re-anonymized.');

        return self::SUCCESS;
    }
}
