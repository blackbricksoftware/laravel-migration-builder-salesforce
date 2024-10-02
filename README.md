# Laravel Migration Builder - Salesforce

## Introduction

This package allows you to create migrations as analogs to Salesforce objects read from a connected org. It is useful for staging data for import or downloading data for warehousing.

See [Laravel Migration Builder](https://github.com/blackbricksoftware/laravel-migration-builder) for more details.

## Prerequisites

- PHP 7.x or higher
- Laravel 6.x or higher
- Composer

## Installation

### Install Package

```bash
composer require blackbricksoftware/laravel-migration-builder-salesforce --dev
```

### Publish Configuration

```bash
php artisan vendor:publish --tag=laravel-migration-builder-salesforce-config
```

## Modify `.env`

Add the following lines to your `.env` file. See the [Salesforce REST API Client for Laravel](https://github.com/omniphx/forrest) page for specific configuration details.

```env
SF_AUTH_METHOD=UserPassword
SF_CONSUMER_KEY=123455
SF_CONSUMER_SECRET=ABCDEF
SF_CALLBACK_URI=https://test.app/callback
SF_LOGIN_URL=https://login.salesforce.com
#SF_LOGIN_URL=https://test.salesforce.com
SF_USERNAME=test@example.com
SF_PASSWORD=password123
```

`SF_AUTH_METHOD=UserPassword` will likely be the easiest method for a CLI application.

`SF_LOGIN_URL` will generally be `https://login.salesforce.com` for a live org or `https://test.salesforce.com` for a sandbox org.

`SF_PASSWORD` will be the user's login password with the user's token concatenated on the end.

## Modify Configuration (Optional)

Change `storage.type` to `object` if you intend to use more than one Salesforce connection.

## Usage

### Commands

- `php artisan make:migration-builder:salesforce:object ObjectName`: Make a migration mirroring the structure of the given object (`ObjectName`).
- `php artisan make:migration-builder:salesforce:object:list`: List available objects in the connected Salesforce org.
- `php artisan make:migration-builder:salesforce:object:debug ObjectName`: Create three files (`ObjectName.var_dump.txt`, `ObjectName.print_r.txt`, and pretty printed `ObjectName.json`) in the `Storage::disk('local')` directory (usually `storage/app/migration-builder/salesforce/`) showing the response from the Salesforce REST API.

## Acknowledgements

- Thanks to omniphx for the [Salesforce REST API Client for Laravel](https://github.com/omniphx/forrest).
- [Salesforce Developer Documentation](https://developer.salesforce.com/docs/atlas.en-us.230.0.api.meta/api/sforce_api_calls_describesobjects_describesobjectresult.htm).
