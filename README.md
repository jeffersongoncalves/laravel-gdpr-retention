# Laravel GDPR Retention

![Laravel GDPR Retention](https://raw.githubusercontent.com/jeffersongoncalves/laravel-gdpr-retention/main/art/jeffersongoncalves-laravel-gdpr-retention.png)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jeffersongoncalves/laravel-gdpr-retention.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-gdpr-retention)
[![Tests](https://img.shields.io/github/actions/workflow/status/jeffersongoncalves/laravel-gdpr-retention/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jeffersongoncalves/laravel-gdpr-retention/actions/workflows/tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jeffersongoncalves/laravel-gdpr-retention.svg?style=flat-square)](https://packagist.org/packages/jeffersongoncalves/laravel-gdpr-retention)

Under the EU General Data Protection Regulation (GDPR), personal data must be kept in a form which permits identification for no longer than necessary (storage limitation, Art. 5(1)(e)). This package reads the `retention` you declared with [laravel-gdpr](https://github.com/jeffersongoncalves/laravel-gdpr)'s `#[PersonalData]`. When a column's period ends, it anonymizes that column, using the column's own strategy.

- **Per column:** each column has its own period. `name` can expire after 1 year while `email` lasts 2.
- **`Keep` columns are nullified when their retention ends.** `Keep` only protects a column from erasure requested by the data subject while a legal duty to store it lasts (Art. 17(3)(b)). Once the retention period is over, that duty is over too.
- **Tombstones:** the package records which column of which record it anonymized, without storing any personal data. Because of that, nothing is anonymized twice (a hash is never hashed again). And after you restore a backup, `gdpr:retention-reapply` erases the data that came back.

> This package gives you tooling. It does not make you compliant on its own. Retention periods need legal review.

## Installation

```bash
composer require jeffersongoncalves/laravel-gdpr-retention
php artisan vendor:publish --tag="gdpr-retention-migrations"
php artisan migrate
```

## Declaring retention

```php
#[PersonalData('name', retention: '1 year', anonymize: AnonymizeStrategy::Mask)]
#[PersonalData('email', retention: '2 years', anonymize: AnonymizeStrategy::Hash)]
#[PersonalData('tax_id', retention: '5 years', anonymize: AnonymizeStrategy::Keep)] // nullified after 5 years
#[PersonalData('notes')]                                                           // no retention: never expires
class Customer extends Model implements HasPersonalData
{
    use InteractsWithPersonalData;
}
```

The period accepts any [CarbonInterval](https://carbon.nesbot.com/docs/#api-interval) string (`'90 days'`, `'5 years'`, ...). It is counted from `created_at`. To count it from another date, implement `HasRetentionStart`. Rows where that date is `null` never expire.

```php
use JeffersonGoncalves\GdprRetention\Contracts\HasRetentionStart;

class Contract extends Model implements HasPersonalData, HasRetentionStart
{
    public static function retentionStartColumn(): string
    {
        return 'ended_at'; // counts from the end of the contract
    }
}
```

## Usage

```bash
php artisan gdpr:retention --dry-run   # what would be anonymized
php artisan gdpr:retention             # anonymize expired columns
php artisan gdpr:retention-reapply     # after restoring a backup
```

```php
// routes/console.php
Schedule::command('gdpr:retention')->daily();
```

### Erasure requested by the data subject (DSAR)

A model may be anonymized outside this package, for example by [laravel-gdpr-dsar](https://github.com/jeffersongoncalves/laravel-gdpr-dsar)'s `erase()` or by calling `$model->anonymizePersonalData()` directly. Those columns get tombstones too, so `gdpr:retention-reapply` also erases them when a backup brings them back. The listener for laravel-gdpr's `PersonalDataAnonymized` event records them, and you don't need to configure anything. The DSAR erasure skips `Keep` columns, so they get no tombstone, and they are still nullified when their own retention ends.

You can also call it from code: `GdprRetention::apply(dryRun: false)` returns one row per model and column with the number of records it anonymized. `GdprRetention::reapply()` returns how many columns it erased again.

## Upgrading to 2.0

2.0 runs on [laravel-privacy](https://github.com/jeffersongoncalves/laravel-privacy), the engine shared by the
LGPD, GDPR, CCPA, US privacy and Quebec suites. The classes, config keys, tables, commands and events of this package
keep their names: your code, config and data need no change. Suites installed side by side never see each other's
events. If you extend a class of this package, it now inherits from its `JeffersonGoncalves\Privacy` base.

## Testing

```bash
composer test
```

## Changelog

See [CHANGELOG](CHANGELOG.md).

## License

The MIT License (MIT). See [License File](LICENSE.md).
