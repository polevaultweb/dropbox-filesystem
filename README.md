dropbox-filesystem
==========

A Dropbox Filesystem module for Codeception.

## Installation
To install simply require the package in the `composer.json` file like

```
composer require --dev polevaultweb/dropbox-filesystem
```

### DropboxFilesystem configuration

DropboxFilesystem extends `Filesystem` module hence any parameter required and available to that module is required and available in `DropboxFilesystem` as well.  

In the suite `.yml` configuration file add the module among the loaded ones with the `authorizationToken`. 

The first thing you need to do is get an authorization token at Dropbox. Unlike [other companies](https://google.com) Dropbox has made this very easy. You can just generate a token in the [App Console](https://www.dropbox.com/developers/apps) for any Dropbox API app. You'll find more info at [the Dropbox Developer Blog](https://blogs.dropbox.com/developers/2014/05/generate-an-access-token-for-your-own-account/).

```yml
  modules:
      enabled:
          - DropboxFilesystem
      config:
          DropboxFilesystem:
              authorizationToken: xxxxxxxxxxxx
``` 

### Supports

* doesDropboxFileExist
* deleteDropboxFile

And assertions

* seeDropboxFile

### Usage

```php
$I = new AcceptanceTester( $scenario );

$I->seeDropboxFile( 'path/to/file.jpg' );
```

