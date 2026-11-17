<?php

namespace JeffersonGoncalves\GdprRetention\Listeners;

use JeffersonGoncalves\Gdpr\Events\PersonalDataAnonymized;
use JeffersonGoncalves\GdprRetention\RetentionManager;

/**
 * Tombstones any anonymization (DSAR erasure, consent records...), so gdpr:retention-reapply covers it too.
 */
class RecordTombstones
{
    public function __construct(protected RetentionManager $retention) {}

    public function handle(PersonalDataAnonymized $event): void
    {
        $this->retention->tombstone($event->model, $event->columns);
    }
}
