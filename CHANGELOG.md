# Changelog

All notable changes to this project will be documented in this file.

## 1.0.0 - 2026-11-17

First release: GDPR storage limitation (Art. 5(1)(e)) for Laravel, part of the laravel-gdpr suite.

- Reads the `retention` declared in `#[PersonalData]` and anonymizes each column, with its own strategy, once its period ends. The period counts from `created_at`, or from the column `HasRetentionStart` returns.
- `Keep` columns are nullified when their retention ends: the legal duty that kept them (Art. 17(3)(b)) is over.
- Tombstones (no personal data) mean nothing is anonymized twice. `gdpr:retention-reapply` erases again anything a backup restore brings back, including DSAR erasures.
- `gdpr:retention [--dry-run]`.

## [Unreleased]
