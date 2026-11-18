# Changelog

All notable changes to this project will be documented in this file.

## 2.0.0 - 2026-11-18

### Breaking

- The engine moves to [laravel-privacy](https://github.com/jeffersongoncalves/laravel-privacy), the base shared by the LGPD, GDPR, CCPA, US privacy and Quebec suites. Every class of this package keeps its name and now extends its `JeffersonGoncalves\Privacy` base. If you extend one of them, check your overrides.

### Unchanged

- Config keys, tables, migrations, commands, events and the `#[PersonalData]` declarations: apps need no change.

### Added

- Suites installed side by side (e.g. LGPD and GDPR) only see their own declarations and events.

## 1.0.0 - 2026-11-17

First release: GDPR storage limitation (Art. 5(1)(e)) for Laravel, part of the laravel-gdpr suite.

- Reads the `retention` declared in `#[PersonalData]` and anonymizes each column, with its own strategy, once its period ends. The period counts from `created_at`, or from the column `HasRetentionStart` returns.
- `Keep` columns are nullified when their retention ends: the legal duty that kept them (Art. 17(3)(b)) is over.
- Tombstones (no personal data) mean nothing is anonymized twice. `gdpr:retention-reapply` erases again anything a backup restore brings back, including DSAR erasures.
- `gdpr:retention [--dry-run]`.

## [Unreleased]
