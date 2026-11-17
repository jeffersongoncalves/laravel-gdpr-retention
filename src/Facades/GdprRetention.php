<?php

namespace JeffersonGoncalves\GdprRetention\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JeffersonGoncalves\GdprRetention\GdprRetention
 */
class GdprRetention extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-gdpr-retention';
    }
}
