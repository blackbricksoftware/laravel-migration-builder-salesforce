# Laravel Salesforce Sync

## Description

Create migration as analogs to Salesforce objects read from a connected org. Useful for staging data for import or downloading data for warehousing.

## Installation

### Install package

`composer require blackbricksoftware/laravel-salesforce-sync --dev`

### Publish configuration

`php artisan vendor:publish --tag=laravel-salesforce-sync-config`

## Modify .env

Add the following lines. See the [Salesforce REST API Client for Laravel](https://github.com/omniphx/forrest) page for specific configuration details.

```
SF_AUTH_METHOD=UserPassword
SF_CONSUMER_KEY=123455
SF_CONSUMER_SECRET=ABCDEF
SF_CALLBACK_URI=https://test.app/callback
SF_LOGIN_URL=https://login.salesforce.com
#SF_LOGIN_URL=https://test.salesforce.com
SF_USERNAME=test@example.com
SF_PASSWORD=password123
```

`SF_AUTH_METHOD=UserPassword` will likely be the easier method for a CLI application. 

`SF_LOGIN_URL` will generally be `https://login.salesforce.com` for a live org or `https://test.salesforce.com` for a sandbox org.

`SF_PASSWORD` will be the user's login password with the user's token concatenated on the end.

## Usage

`php artisan make:migration-builder:salesforce-object ObjectName`

# Acknowledgement

