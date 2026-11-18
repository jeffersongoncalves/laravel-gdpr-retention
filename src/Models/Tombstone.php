<?php

namespace JeffersonGoncalves\GdprRetention\Models;

use JeffersonGoncalves\Privacy\Retention\Tombstone as BaseTombstone;

class Tombstone extends BaseTombstone
{
    public function getTable(): string
    {
        return config('gdpr-retention.table', 'gdpr_retention_tombstones');
    }
}
