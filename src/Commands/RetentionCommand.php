<?php

namespace JeffersonGoncalves\GdprRetention\Commands;

use Illuminate\Console\Command;
use JeffersonGoncalves\GdprRetention\RetentionManager;

class RetentionCommand extends Command
{
    protected $signature = 'gdpr:retention {--dry-run : Only count the records that would be anonymized}';

    protected $description = 'Anonymize personal data whose retention period has ended';

    public function handle(RetentionManager $retention): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $report = $retention->apply($dryRun);

        if ($report === []) {
            $this->info('No personal data with a retention period declared.');

            return self::SUCCESS;
        }

        $this->table(['Model', 'Column', 'Retention', $dryRun ? 'Would anonymize' : 'Anonymized'], $report);

        return self::SUCCESS;
    }
}
