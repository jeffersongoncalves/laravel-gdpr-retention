<?php

namespace JeffersonGoncalves\GdprRetention;

use JeffersonGoncalves\Gdpr\Gdpr;
use JeffersonGoncalves\GdprRetention\Models\Tombstone;
use JeffersonGoncalves\Privacy\Retention\RetentionManager as BaseRetentionManager;

/**
 * Anonymizes personal data whose retention period has ended, tombstones every anonymization of the suite and
 * re-applies them after a backup restore.
 */
class RetentionManager extends BaseRetentionManager
{
    protected string $config = 'gdpr-retention';

    protected string $tombstone = Tombstone::class;

    public function __construct(Gdpr $gdpr)
    {
        parent::__construct($gdpr);
    }
}
