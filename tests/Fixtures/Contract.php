<?php

namespace JeffersonGoncalves\GdprRetention\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use JeffersonGoncalves\Gdpr\Attributes\PersonalData;
use JeffersonGoncalves\Gdpr\Concerns\InteractsWithPersonalData;
use JeffersonGoncalves\Gdpr\Contracts\HasPersonalData;
use JeffersonGoncalves\GdprRetention\Contracts\HasRetentionStart;

#[PersonalData('signer', retention: '1 year')]
class Contract extends Model implements HasPersonalData, HasRetentionStart
{
    use InteractsWithPersonalData;

    protected $guarded = [];

    public $timestamps = false;

    public static function retentionStartColumn(): string
    {
        return 'ended_at';
    }
}
